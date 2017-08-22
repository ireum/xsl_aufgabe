<?php

namespace library
{

    include 'autoload.php';
    try {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $request = new PostRequest($_POST);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $request = new GetRequest($_GET);
        } else {
            throw new \RuntimeException('Unexpected Request Method');
        }

        $xmlPath = __DIR__ . '/books.xml';
        $xslPath = __DIR__ . '/xslt.xsl';

        $xp = new XmlProcessor($xmlPath);
        $sfp = new SearchFormProcessor($xmlPath, $request, $xp);

        $xslParser = new \XSLTProcessor();
        $xslParser->importStylesheet(simplexml_load_file($xslPath));

        $sfp->processForm();
        echo $xslParser->transformToDoc($sfp->getSxmlElement())->saveXML();

    } catch (\InvalidArgumentException $e) {
        echo $e->getMessage() . PHP_EOL;
    } catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}
?>
