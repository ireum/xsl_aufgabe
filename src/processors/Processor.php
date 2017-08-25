<?php


namespace library\processor
{

    use library\requests\AbstractRequest;
    use library\routing\HtmlResponse;

    interface Processor
    {
        public function execute(HtmlResponse $response, AbstractRequest $request);
    }
}
