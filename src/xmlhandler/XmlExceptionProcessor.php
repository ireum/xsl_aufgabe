<?php


namespace library\xmlhandler
{


    use library\requests\AbstractRequest;

    class XmlExceptionProcessor
    {
        /** @var \DOMDocument */
        private $dom;

        public function __construct()
        {
            $this->dom = new \DOMDocument();
            $this->dom->load(__DIR__ . '/../pages/add.xml');
//            $this->dom = $dom;
        }

        public function resetException()
        {
            $this->dom->getElementsByTagName('exception')->item(0)->setAttribute('bool', 'false');
            $this->saveDom();
        }

        private function saveDom()
        {
            $this->dom->save(__DIR__ . '/../pages/add.xml');
        }

        function processFormException(\Exception $e, AbstractRequest $request)
        {
            $this->dom->getElementsByTagName('exception')->item(0)->setAttribute('bool', 'true');
            $this->dom->getElementsByTagName('invalidField')->item(0)->nodeValue = $e->getMessage();
            $this->dom->getElementsByTagName('exceptionMessage')->item(0)->nodeValue = 'Invalid Field: ' . $e->getMessage();

            $xpath = new \DOMXPath($this->dom);
            $fields = $xpath->query('/formData/fields/*');
            foreach ($fields as $field) {
                if ($field->nodeName === $e->getMessage()) {
                    $this->dom->getElementsByTagName($field->nodeName)->item(0)->nodeValue = null;
                } else {

                    $this->dom->getElementsByTagName($field->nodeName)->item(0)->nodeValue = $request->get($field->nodeName);
                }
                $this->saveDom();
            }
        }
    }
}
