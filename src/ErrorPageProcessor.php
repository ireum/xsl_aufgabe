<?php


namespace library
{

    class ErrorPageProcessor
    {
        public function __construct()
        {
        }

        public function execute(HtmlResponse $response)
        {
            $response->setBody('<html><h1>Error: 404</h1></html>');
        }
    }
}
