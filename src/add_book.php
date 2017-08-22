<?php
include 'autoload.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request = new \library\PostRequest($_POST);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $request = new \library\GetRequest($_GET);
} else {
    throw new \RuntimeException('Unexpected Request Method');
}

if ($request->has('submit') &&
    $request->get('author') &&
    $request->get('title') &&
    $request->get('genre') &&
    $request->get('price') &&
    $request->get('releaseDate') &&
    $request->get('description')
) {
    try {

        $formValidation = new \library\AddBookFormValidation($request);
        if ($formValidation->isValid()) {
            $xmlFile = __DIR__ . '/books.xml';
            $xmlP = new \library\XmlProcessor($xmlFile);
            $xmlE = new \library\XmlEditor($xmlFile, $request, $xmlP);

            $xmlE->addBook();
            header('Location: index.php');
        }
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
    }
}

$add = simplexml_load_file('add.xml');
echo $add->saveXML();
?>
