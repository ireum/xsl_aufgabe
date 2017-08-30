<?php


namespace library\processor
{

    use library\requests\AbstractRequest;
    use library\routing\HtmlResponse;
    use library\routing\Session;

    interface Processor
    {
        public function execute(
            HtmlResponse $response,
            AbstractRequest $request,
            Session $session
        );
    }
}
