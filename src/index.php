<?php

include 'autoload.php';
try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $request = new \library\PostRequest($_POST);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $request = new \library\GetRequest($_GET);
    } else {
        throw new \RuntimeException('Unexpected Request Method');
    }

    $xmlFile = __DIR__ . '/books.xml';
    $xslFile = __DIR__ . '/xslt.xsl';

    $xp = new \library\XmlProcessor($xmlFile);
    $fb = new \library\FormBuilder();
    $sfp = new \library\SearchFormProcessor($request);

} catch (\InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

$xmlDom = simplexml_load_file('books.xml');

$xslDom = new DOMDocument();
$xslDom->load('xslt.xsl');



$minPrice = $xp->getMinPrice();
$maxPrice = $xp->getMaxPrice();

//$fb->buildValueSelectFromArray($xp->getAuthors(), 'author'

$xslTest = simplexml_load_file($xslFile);
//$aSelect = $xslTest->xpath('/html/body/form/select[@name="authorSelect"]');

//$aSelect = $xslTest->xpath('//form')[0];
//$aSelect->addChild($fb->buildValueSelectFromArray($xp->getAuthors(), 'author'));
//$xslTest->saveXML();
//var_dump($xslTest->xpath('//form'));

$xslParser = new XSLTProcessor();
$xslParser->importStylesheet(simplexml_load_file($xslFile));

if (isset($_GET['submit'])) {


    if ($_GET['sort'] == 'price') {
        $datatype = 'number';
    } else {
        $datatype = 'text';
    }
    //sort
    $xmlDom->addAttribute('sortby', $_GET['sort']);
    $xmlDom->addAttribute('sortdatatype', $datatype);
    // normal
    $xmlDom->addAttribute('author', $_GET['author']);
    $xmlDom->addAttribute('title', $_GET['title']);
    $xmlDom->addAttribute('minprice', $_GET['minPrice']);
    $xmlDom->addAttribute('maxprice', $_GET['maxPrice']);
} else {
//    $xmlDom->addAttribute('sortby', 'author');
//    $xmlDom->addAttribute('sortdatatype', 'text');
//    // normal
//    $xmlDom->addAttribute('author', '');
//    $xmlDom->addAttribute('title', '');
//    $xmlDom->addAttribute('minprice', $minPrice);
//    $xmlDom->addAttribute('maxprice', $maxPrice);
}


?>

<!-- TODO: move html to xsl file-->
<head>
    <title>Library</title>
    <link rel="stylesheet" href="lib.css">
</head>
<body>
<header>
    <a href="index.php"><h1>Library</h1></a>
    <a class="add_book" href="add_book.php">Add Book</a>
</header>

<form action="" method="get">
    <?php
    echo $fb->buildValueSelectFromArray($xp->getAuthors(), 'author')
    ?>
    <input name="title" type="text" placeholder="Title"/>
    <input name="minPrice" type="number" step="0.05" value="<?php echo $minPrice; ?>" min="<?php echo $minPrice; ?>"
           max="<?php echo $maxPrice; ?>"/>
    <input name="maxPrice" type="number" step="0.05" value="<?php echo $maxPrice; ?>" min="<?php echo $minPrice; ?>"
           max="<?php echo $maxPrice; ?>"/>

    <?php
    echo $fb->buildNameSelectFromArray($xp->getSortTypes(), 'sort');
    ?>
    <input class="submit_button" name="submit" type="submit" value="Search"/>
</form>

<?php

//echo $xmlDom->saveXML();
echo $xslParser->transformToDoc($xmlDom)->saveXML();
?>
</body>
