<?php

namespace library
{
    include 'autoload.php';

    try {
        $xp = new XmlProcessor(__DIR__ . '/books.xml');
        echo $xp->getMinPrice() . PHP_EOL;
        echo $xp->getMaxPrice() . PHP_EOL;
        echo $xp->getNextId() . PHP_EOL;
        var_dump($xp->getSortTypes());


        $_POST['author'] = 'Wijaya Sudarta';
        $_POST['price'] = 0.2;
        $_POST['releaseDate'] = '1969-01-01';

        $fv = new AddBookFormValidation();

        if ($fv->isValid()) {
            echo 'from is valid';
        } else {
            echo 'invalid form';
        }

    } catch (\InvalidArgumentException $e) {
        echo $e->getMessage() . PHP_EOL;
    } catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }

}
