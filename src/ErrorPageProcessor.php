<?php


namespace library
{

    class ErrorPageProcessor implements Processor
    {
        public function __construct()
        {
        }

        public function execute(HtmlResponse $response, AbstractRequest $request)
        {
            $response->setBody('<html><h1>Error: 404</h1></html>');
        }
    }
}
