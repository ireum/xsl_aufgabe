<?php
?>
<html>
<head>
    <title>Add Book</title>
    <link rel="stylesheet" href="lib.css">
</head>
<body>
<header>
    <h1>Add Book</h1>
</header>
<div class="add_book_form_container">
    <form class="add_book_form" action="" method="post">
        <input type="text" name="author" placeholder="Author">
        <input type="text" name="title" placeholder="Title">
        <input type="text" name="genre" placeholder="Genre">
        <input type="number" step="0.05" name="price" placeholder="Price">
        <input type="text" name="releaseDate" placeholder="Release Date (YYYY-MM-DD)">
        <textarea name="description" placeholder="Description" cols="30" rows="10"></textarea>
        <input type="submit" name="submit" class="submit_button">
    </form>
</div>
</body>
</html>
