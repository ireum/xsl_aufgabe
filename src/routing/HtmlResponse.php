<?php


namespace library\routing
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
            if (is_null($this->body)) {
                throw new \Exception('Body is empty');
            }
            return $this->body;
        }

        public function setRedirect(string $redirect)
        {
            $this->redirect = $redirect;
        }

        private function hasRedirect(): bool
        {
            if (!isset($this->redirect)) {
                return false;
            }
            return true;
        }

        public function getRedirect()
        {
            if ($this->hasRedirect()) {
                return header('Location: ' . $this->redirect);
            }
        }
    }
}
