<?php


namespace library\routing
{

    class Session
    {
        /** @var array */
        private $inputVariables;
        private $errorXml;

        public function __construct(array $inputVariables)
        {
            $this->inputVariables = $inputVariables;
        }


        public function set(string $key, $value)
        {
            $this->inputVariables[$key] = $value;
        }

        public function has(string $key): bool
        {
            return isset($this->inputVariables[$key]);
        }

        public function get(string $key): string
        {
            if (!$this->has($key)) {
                throw new \InvalidArgumentException(sprintf('Key "%s" not found', $key));
            }
            return $this->inputVariables[$key];
        }

        public function hasError()
        {
            if (isset($this->inputVariables['errorXml'])) {
                return true;
            } else {

                return false;
            }
        }

        public function setErrorXml(\DOMDocument $document)
        {
            $this->set('errorXml', $document->saveXML());
        }

        public function getErrorXml(): \DOMDocument
        {
            $dom = new \DOMDocument();
            $dom->loadXML($this->get('errorXml'));
            return $dom;
        }

        public function resetErrorXml()
        {
            $this->set('errorXml', null);
        }

        public function getSessionValues(): array
        {
            //Diese Methode darf nur im bootstrapping aufgerufen werden
            return $this->inputVariables;
        }

    }
}
