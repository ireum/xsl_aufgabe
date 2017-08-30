<?php


namespace library\routing
{

    use library\book\Book;
    use library\requests\AbstractRequest;

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

        public function resetErrorXml()
        {
            $this->errorXml = null;
            $this->inputVariables = null;
        }

        public function hasError()
        {
            if (isset($this->inputVariables['errorFields'])) {
                return true;
            } else {

                return false;
            }
        }

        public function generateErrorXml()
        {
            $this->hasErrorXml = true;
            $dom = new \DOMDocument();
            $dom->load(__DIR__ . '/../pages/add.xml');

            $xpath = new \DOMXPath($dom);
            $fields = $xpath->query('/formData/fields/*');
            foreach ($fields as $field) {
                if (array_key_exists($field->nodeName, $this->inputVariables['errorFields'])) {
                    $dom->getElementsByTagName($field->nodeName)->item(0)->setAttribute('invalidField', 'true');
                    $dom->getElementsByTagName($field->nodeName)->item(0)->nodeValue = $this->inputVariables['errorFields'][$field->nodeName];
                } else {
                    $dom->getElementsByTagName($field->nodeName)->item(0)->nodeValue = $this->inputVariables['request'][$field->nodeName];
                }
            }
            return $dom;
        }

    }
}
