<?php
?>
<html>
<head>
    <title>Library</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<form action="" method="post">
    <select name="author">
        <option value="">author</option>
    </select>
    <input type="text" placeholder="Title">
    <input type="number"  min="" max="">
    <input type="number"  min="" max="">

    <input type="submit" value="Search">

</form>



<table class="table">
    <tr>
        <th class="table-header">ID</th>
        <th class="table-header">Author</th>
        <th class="table-header">Title</th>
        <th class="table-header">Genre</th>
        <th class="table-header">Price</th>
        <th class="table-header">Release Date</th>
        <th class="table-header">Description</th>
    </tr>
    <?php

    $xml = simplexml_load_file('books.xml');
    $bookId = $xml->xpath('/catalog/book/@id');
    foreach ($bookId as $id) {
        echo $id . '<br>';

//        echo '<tr>';
//        echo '<td>' . $id . '</td>';
//        echo '</tr>';

    }

    ?>


    <!-- <tr>
        <td class="table-value">1</td>
        <td class="table-value">Wijaya Sudarta</td>
        <td class="table-value">XML Tests</td>
        <td class="table-value">Drama</td>
        <td class="table-value">1.99</td>
        <td class="table-value">19.07.2022</td>
        <td class="table-value">tests</td>
    </tr> -->
</table>
</body>
</html>
