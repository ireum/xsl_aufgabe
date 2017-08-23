<?php


namespace library
{

    interface Processor
    {
        public function execute(HtmlResponse $response);
    }
}
