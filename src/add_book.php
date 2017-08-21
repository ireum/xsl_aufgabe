<?php

if (isset($_POST['submit']) &&
    isset($_POST['author']) &&
    isset($_POST['title']) &&
    isset($_POST['genre']) &&
    isset($_POST['price']) &&
    isset($_POST['releaseDate']) &&
    isset($_POST['description'])
) {
    function validateDate(string $date)
    {
        $vDate = DateTime::createFromFormat('Y-m-d', $date);
        return $vDate && $vDate->format('Y-m-d') == $date;
    }

    function getNewId(string $xmlFile): string
    {
        $sxml = simplexml_load_file($xmlFile);
        $lastBookID = $lastID = $sxml->xpath('//book[last()]/@id')[0][0];
        $newId = substr($lastBookID, 2);
        $newId++;
        echo $newId . '<br>';
        return 'bk' . $newId;
    }

    $valid = true;

    $author = $_POST['author'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $price = null;
    $releaseDate = null;
    $description = $_POST['description'];

    if (!validateDate($_POST['releaseDate'])) {
        echo '<p style="color: red; font-weight: bold">DATE INVALID</p><br>';
        $valid = false;
    }

    if (!is_numeric($_POST['price'])) {
        echo '<p style="color: red; font-weight: bold">PRICE INVALID</p><br>';
        $valid = false;
    }
    $price = $_POST['price'];
    $releaseDate = $_POST['releaseDate'];

    if ($valid) {
        $xmlFile = 'books.xml';
        $dom = new DOMDocument();
        $dom->load($xmlFile);

        $root = $dom->getElementsByTagName('catalog')->item(0);
        $books = $dom->getElementsByTagName('book');

        $book = $dom->createElement('book');
        $book->setAttribute('id', getNewId($xmlFile));

        $book->appendChild($dom->createElement('author', $author));
        $book->appendChild($dom->createElement('title', $title));
        $book->appendChild($dom->createElement('genre', $genre));
        $book->appendChild($dom->createElement('price', $price));
        $book->appendChild($dom->createElement('publish_date', $releaseDate));
        $book->appendChild($dom->createElement('description', $description));
        $root->appendChild($book);

        $dom->save($xmlFile);
        header('Location: index.php');
    }
}

if (isset($_POST['cancel'])) {
    echo 'HELLO';
    header("Location: index.php");
    die();
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
        <div class="submit_button btnCancelBook"><a href="index.php" >Cancel</a></div>
    </form>
</div>
</body>
</html>
