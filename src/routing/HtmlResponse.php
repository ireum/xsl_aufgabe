<?php


namespace library
{

    class HtmlResponse
    {
        /** @var string */
        private $body;

        /** @var string */
        private $redirect;

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

        public function setRedirect(string $redirect)
        {
            $this->redirect = $redirect;
        }

        public function hasRedirect(): bool
        {
            if (!isset($this->redirect)) {
                return false;
            }
            return true;
        }

        public function getRedirect()
        {
            return header('Location: ' . $this->redirect);
        }
    }
}
