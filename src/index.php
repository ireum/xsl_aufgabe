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
    $sfp = new \library\SearchFormProcessor($xmlPath, $request, $xp);

    $xslParser = new XSLTProcessor();
    $xslParser->importStylesheet(simplexml_load_file($xslPath));

    $sfp->processForm();
    echo $xslParser->transformToDoc($sfp->getSxmlElement())->saveXML();

} catch (\InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
?>
