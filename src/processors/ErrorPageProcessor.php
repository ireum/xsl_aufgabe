<?php


namespace library\processor
{

    use library\requests\AbstractRequest;
    use library\routing\HtmlResponse;
    use library\routing\Session;

    class ErrorPageProcessor implements Processor
    {
        public function __construct()
        {
        }

        public function execute(
            HtmlResponse $response,
            AbstractRequest $request,
            Session $session
        )
        {
            $response->setBody('<html><head><link rel="stylesheet" href="/css/lib.css"/></head><h1>Error: 404</h1></html>');
        }
    }
}
