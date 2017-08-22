<?php

include 'autoload.php';
if (isset($_POST['submit']) &&
    isset($_POST['author']) &&
    isset($_POST['title']) &&
    isset($_POST['genre']) &&
    isset($_POST['price']) &&
    isset($_POST['releaseDate']) &&
    isset($_POST['description'])
) {
    try {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $request = new \library\PostRequest($_POST);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $request = new \library\GetRequest($_GET);
        } else {
            throw new \RuntimeException('Unexpected Request Method');
        }
        $formValidation = new \library\AddBookFormValidation($request);
        if ($formValidation->isValid()) {

            $xmlFile = __DIR__ . '/books.xml';
            $xmlP = new \library\XmlProcessor($xmlFile);
            $xmlE = new \library\XmlEditor($xmlFile, $request, $xmlP);

            $xmlE->addBook();



        }
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
    }
}

$add = simplexml_load_file('add.xml');
echo $add->saveXML();
?>
