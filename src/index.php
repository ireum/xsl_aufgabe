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

    $xmlPath = __DIR__ . '/books.xml';
    $xslPath = __DIR__ . '/xslt.xsl';

    $xp = new \library\XmlProcessor($xmlPath);
    $sfp = new \library\SearchFormProcessor($request);

} catch (\InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

$xmlDom = simplexml_load_file($xmlPath);

$xslParser = new XSLTProcessor();
$xslParser->importStylesheet(simplexml_load_file($xslPath));

if (isset($_GET['submit'])) {
    $xmlDom->addAttribute('sortby', $_GET['sort']);
    $xmlDom->addAttribute('sortdatatype', $sfp->getDataType());
    $xmlDom->addAttribute('author', $_GET['author']);
    $xmlDom->addAttribute('title', $_GET['title']);
    $xmlDom->addAttribute('minprice', $_GET['minPrice']);
    $xmlDom->addAttribute('maxprice', $_GET['maxPrice']);
} else {
    $xmlDom->addAttribute('sortby', 'author');
    $xmlDom->addAttribute('sortdatatype', 'text');
    $xmlDom->addAttribute('author', '');
    $xmlDom->addAttribute('title', '');
    $xmlDom->addAttribute('minprice', $xp->getMinPrice());
    $xmlDom->addAttribute('maxprice', $xp->getMaxPrice());
}
echo $xslParser->transformToDoc($xmlDom)->saveXML();
?>
