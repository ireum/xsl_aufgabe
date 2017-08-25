<?php


namespace library
{


    class XmlExceptionProcessor
    {
        /** @var \DOMDocument */
        private $dom;

        public function __construct($dom)
        {
            $this->dom = new \DOMDocument();
            $this->dom->load(__DIR__ . '/../pages/add.xml');
            $this->dom = $dom;
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

        function processFormException(\InvalidArgumentException $e, AbstractRequest $request)
        {
            $this->dom->getElementsByTagName('exception')->item(0)->setAttribute('bool', 'true');
            $this->dom->getElementsByTagName('invalidField')->item(0)->nodeValue = $e->getMessage();
            $this->dom->getElementsByTagName('exceptionMessage')->item(0)->nodeValue = 'Invalid Field: ' . $e->getMessage();
            $this->dom->getElementsByTagName('author')->item(0)->nodeValue = $request->get('author');
            $this->dom->getElementsByTagName('title')->item(0)->nodeValue = $request->get('title');
            $this->dom->getElementsByTagName('genre')->item(0)->nodeValue = $request->get('genre');
            $this->dom->getElementsByTagName('price')->item(0)->nodeValue = $request->get('price');
            $this->dom->getElementsByTagName('releaseDate')->item(0)->nodeValue = $request->get('releaseDate');
            $this->dom->getElementsByTagName('description')->item(0)->nodeValue = $request->get('description');
            $this->saveDom();
        }
    }
}
