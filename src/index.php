<?php

$xmlDom = new DOMDocument();
$xmlDom->load('books.xml');


//if (isset($_GET['foo'])) {
//    $foo = $_GET['foo'];
//} else {
//    $foo = '';
//}


$foo = 'bar';
$xmlDom->documentElement->setAttribute('foo', $foo);

$xslDom = new DOMDocument();
$xslDom->load('xslt.xsl');

$xslParser = new XSLTProcessor();
$xslParser->importStylesheet($xslDom);

echo $xslParser->transformToDoc($xmlDom)->saveXML();

?>
<br>
<h2>Library</h2>
<form >
    <select name="author">
            <option value="{author}">Author Name</option>
    </select>
    <input name="title" type="text" placeholder="Title"/>
    <input name="minPrice" type="number" value="0" min="0" max="100"/>
    <input name="maxPrice" type="number" value="100" min="0" max="100"/>

    <select  name="sort">
        <?php
        $sortTypes = $xmlDom->

//        descriptions = $xml->xpath(
//            "//e:product[@sku='12345']/e:description |
//                //e:product[@name='Projektor']/e:description"
//        );
//        echo 'Aufgabe 2' . PHP_EOL;
//        foreach ($descriptions as $description) {
//            echo 'Found: ' . $description . PHP_EOL;
//        }
//        echo PHP_EOL;

        ?>

        <option value="author">author</option>
        <option value="title">title</option>
    </select>

    <input type="submit" value="Search"/>
</form>
