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

            $sr = simplexml_load_file($xmlFile);
            $root = $sr->xpath('/catalog')[0];
//            $root = $xmlP->getRootElementByName('catalog');

            $book = $root->addChild('book');
            $book->addAttribute('id', $xmlP->getNextId());
            $book->addChild('author', $_POST['author']);
            $book->addChild('title', $_POST['title']);
            $book->addChild('genre', $_POST['genre']);
            $book->addChild('price', $_POST['price']);
            $book->addChild('publish_date', $_POST['releaseDate']);
            $book->addChild('description', $_POST['description']);


            $sr->saveXML($xmlFile);

            // TODO: Class for creating Nodes and appending them
//            $dom = new DOMDocument();
//            $dom->load($xmlFile);

//            $root = $dom->getElementsByTagName('catalog')->item(0);
////            $books = $dom->getElementsByTagName('book');
//
//            $book = $dom->createElement('book');
//            $book->setAttribute('id', $xmlP->getNextId());
//
//            $book->appendChild($dom->createElement('author', $_POST['author']));
//            $book->appendChild($dom->createElement('title', $_POST['title']));
//            $book->appendChild($dom->createElement('genre', $_POST['genre']));
//            $book->appendChild($dom->createElement('price', $_POST['price']));
//            $book->appendChild($dom->createElement('publish_date', $_POST['releaseDate']));
//            $book->appendChild($dom->createElement('description', $_POST['description']));
//            $root->appendChild($book);
//
//            $dom->save($xmlFile);
//            header('Location: index.php');

        }
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
    }
}
?>
<html>
<head>
    <title>Add Book</title>
    <link rel="stylesheet" href="lib.css">
</head>
<body>
<header>
    <a href="index.php"><h1>Library</h1></a>
</header>
<div class="add_book_form_container">
    <h2>Add Book</h2>
    <form class="add_book_form" action="" method="post">
        <input type="text" name="author" placeholder="Author" required>
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="genre" placeholder="Genre" required>
        <input type="number" step="0.05" name="price" placeholder="Price" required>
        <input type="text" name="releaseDate" placeholder="Release Date (YYYY-MM-DD)" required>
        <textarea name="description" placeholder="Description" cols="30" rows="10" required></textarea>
        <input type="submit" name="submit" class="submit_button btnAddBook">
        <input type="reset" name="reset" class="submit_button btnResetBook">
        <div class="submit_button btnCancelBook"><a href="index.php">Cancel</a></div>
    </form>
</div>
</body>
</html>
