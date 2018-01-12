<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'library\\backends\\filebackendtest' => '/unit/Backends/FileBackendTest.php',
                'library\\configurationtest' => '/unit/ConfigurationTest.php',
                'library\\exceptions\\errorexceptiontest' => '/unit/Exceptions/ErrorExceptionTest.php',
                'library\\exceptions\\invalidbookexceptiontest' => '/unit/Exceptions/InvalidBookExceptionTest.php',
                'library\\factories\\factorytest' => '/unit/Factory/FactoryTest.php',
                'library\\handler\\bookappendertest' => '/unit/Handler/BookAppenderTest.php',
                'library\\handler\\booksquerytest' => '/unit/Handler/BooksQueryTest.php',
                'library\\handler\\errorxmlgeneratortest' => '/unit/Handler/ErrorXmlGeneratorTest.php',
                'library\\handler\\libraryfiltertest' => '/unit/Handler/LibraryFilterTest.php',
                'library\\processor\\addbookprocessortest' => '/unit/Processors/AddBookProcessorTest.php',
                'library\\processor\\displaybookformprocessortest' => '/unit/Processors/DisplayBookFormProcessorTest.php',
                'library\\processor\\errorpageprocessortest' => '/unit/Processors/ErrorPageProcessorTest.php',
                'library\\processor\\libraryprocessortest' => '/unit/Processors/LibraryProcessorTest.php',
                'library\\requests\\abstractrequesttest' => '/unit/Request/AbstractRequestTest.php',
                'library\\responder\\htmlresponsetest' => '/unit/Responder/HtmlResponseTest.php',
                'library\\responder\\uritest' => '/unit/Responder/UriTest.php',
                'library\\routers\\routertest' => '/unit/Routers/RouterTest.php',
                'library\\session\\sessiontest' => '/unit/Session/SessionTest.php',
                'library\\valueobject\\booktest' => '/unit/ValueObjects/BookTest.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd
