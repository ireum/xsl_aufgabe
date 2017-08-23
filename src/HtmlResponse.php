<?php


namespace library
{

    class HtmlResponse
    {
        /** @var string */
        private $body;

        public function __construct()
        {
        }

        public function setBody(string $body)
        {
            $this->body = $body;
        }

        public function getBody(): string
        {
            return $this->body;
        }
    }
}
