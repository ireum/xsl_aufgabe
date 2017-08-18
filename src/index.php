<?php

$xmlDom = new DOMDocument();
$xmlDom->load('books.xml');

$xmlDom = simplexml_load_file('books.xml');

$xslDom = new DOMDocument();
$xslDom->load('xslt.xsl');

$xslParser = new XSLTProcessor();
$xslParser->importStylesheet($xslDom);

$sortTypes = $xmlDom->xpath('/catalog/book[1]/*');
$authors = $xmlDom->xpath('/catalog/book/author');


$Prices = $xmlDom->xpath('/catalog/book/price');
sort($Prices, SORT_NUMERIC);
$minPrice = $Prices[0];
$maxPrice = end($Prices);


?>

<?php
if (isset($_POST['submit'])) {

    if ($_POST['sort'] == 'publish_date') {
        $datatype = 'text';
        $order = 'ascending';
    } elseif ($_POST['sort'] == 'price') {
        $datatype = 'number';
        $order = 'ascending';
    } else {
        $datatype = 'text';
        $order = 'ascending';
    }
    //sort
    $xmlDom->addAttribute('sortby', $_POST['sort']);
    $xmlDom->addAttribute('sortdatatype', $datatype);
    $xmlDom->addAttribute('order', $order);
    // normal
    $xmlDom->addAttribute('author', $_POST['author']);
    $xmlDom->addAttribute('title', $_POST['title']);
    $xmlDom->addAttribute('minprice', $_POST['minPrice']);
    $xmlDom->addAttribute('maxprice', $_POST['maxPrice']);
} else {
    $xmlDom->addAttribute('sortby', 'author');
    $xmlDom->addAttribute('sortdatatype', 'text');
    $xmlDom->addAttribute('order', 'ascending');
    // normal
    $xmlDom->addAttribute('author', '');
    $xmlDom->addAttribute('title', '');
    $xmlDom->addAttribute('minprice', $minPrice);
    $xmlDom->addAttribute('maxprice', $maxPrice);
}



if (isset($_POST['addBook'])) {
    echo 'HELLO';
    header("Location: add_book.php");
    die();
}

?>

<head>
    <title>Library</title>
    <link rel="stylesheet" href="lib.css">
</head>
<body>
<header>
    <a href="index.php"><h1>Library</h1></a>
    <a class="add_book" href="add_book.php">Add Book</a>
</header>
<form action="" method="post">
    <select name="author">
        <option value="">All</option>
        <?php
        $noDuplicates = array();
        foreach (array_unique($authors, SORT_STRING) as $author) {
            if (!in_array($author, $noDuplicates)) {
                $noDuplicates[] = $author;
                echo '<option value="' . $author . '">';
                echo $author . '<br>';
                echo '</option>';
            }
        }
        ?>
    </select>
    <input name="title" type="text" placeholder="Title"/>
    <input name="minPrice" type="number" step="0.05" value="<?php echo $minPrice; ?>" min="<?php echo $minPrice;  ?>"
           max="<?php echo $maxPrice; ?>"/>
    <input name="maxPrice" type="number" step="0.05" value="<?php echo $maxPrice; ?>" min="<?php echo $minPrice; ?>"
           max="<?php echo $maxPrice; ?>"/>

    <select name="sort">
        <?php
        foreach ($sortTypes as $sortType) {
            echo '<option value="' . $sortType->getName() . '">';
            echo $sortType->getName() . '<br>';
            echo '</option>';
        }
        ?>
    </select>

    <input class="submit_button" name="submit" type="submit" value="Search"/>
</form>

<?php

//echo $xmlDom->saveXML();
echo $xslParser->transformToDoc($xmlDom)->saveXML();
?>
</body>
