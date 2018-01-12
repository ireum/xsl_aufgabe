<?php


namespace library\processor
{

    use library\requests\AbstractRequest;
    use library\responder\HtmlResponse;
    use library\session\Session;

    interface Processor
    {
        public function execute(
            HtmlResponse $response,
            AbstractRequest $request
        );
    }
}
