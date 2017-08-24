<?php


namespace library
{

    class DisplayBookFormProcessor
    {

        public function __construct()
        {
        }

        public function execute(HtmlResponse $response)
        {
            $xml = simplexml_load_file('pages/add.xml');
            $response->setBody($xml->saveXML());
        }

    }
}
