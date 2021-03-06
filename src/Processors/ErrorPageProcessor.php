<?php


namespace library\processor
{

    use library\requests\AbstractRequest;
    use library\responder\HtmlResponse;
    use library\session\Session;

    class ErrorPageProcessor implements Processor
    {
        public function __construct()
        {
        }

        public function execute(
            HtmlResponse $response,
            AbstractRequest $request
        )
        {
            $response->setBody('<html><head><link rel="stylesheet" href="/css/lib.css"/></head><h1>Error: 404</h1></html>');
        }
    }
}
