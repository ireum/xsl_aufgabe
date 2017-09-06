<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'library\\backends\\filebackend' => '/Backends/FileBackend.php',
                'library\\configuration' => '/Configuration.php',
                'library\\exceptions\\errorexception' => '/Exceptions/ErrorException.php',
                'library\\exceptions\\invalidbookexception' => '/Exceptions/InvalidBookException.php',
                'library\\factories\\factory' => '/Factories/Factory.php',
                'library\\handler\\bookappender' => '/Handler/BookAppender.php',
                'library\\handler\\booksquery' => '/Handler/BooksQuery.php',
                'library\\handler\\errorxmlgenerator' => '/Handler/ErrorXmlGenerator.php',
                'library\\handler\\libraryfilter' => '/Handler/LibraryFilter.php',
                'library\\processor\\addbookprocessor' => '/Processors/AddBookProcessor.php',
                'library\\processor\\displaybookformprocessor' => '/Processors/DisplayBookFormProcessor.php',
                'library\\processor\\errorpageprocessor' => '/Processors/ErrorPageProcessor.php',
                'library\\processor\\libraryprocessor' => '/Processors/LibraryProcessor.php',
                'library\\processor\\processor' => '/Processors/Processor.php',
                'library\\requests\\abstractrequest' => '/Requests/AbstractRequest.php',
                'library\\requests\\getrequest' => '/Requests/GetRequest.php',
                'library\\requests\\postrequest' => '/Requests/PostRequest.php',
                'library\\responder\\htmlresponse' => '/Responder/HtmlResponse.php',
                'library\\responder\\uri' => '/Responder/Uri.php',
                'library\\routers\\router' => '/Routers/Router.php',
                'library\\session\\session' => '/Session/Session.php',
                'library\\valueobject\\book' => '/ValueObjects/Book.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd
