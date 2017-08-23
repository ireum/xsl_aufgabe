<?php


namespace library
{
    class SearchFormProcessor
    {
        /** @var AbstractRequest */
        private $request;

        /** @var  \DOMDocument */
        private $dom;

        /** @var XmlProcessor */
        private $xmlProcessor;

        public function __construct(string $path, AbstractRequest $request, XmlProcessor $xmlProcessor)
        {
            $this->setDom($path);
            $this->request = $request;
            $this->xmlProcessor = $xmlProcessor;
        }

        private function setDom(string $path)
        {
            $domDoc = new \DOMDocument();
            $domDoc->load($path);
            $this->dom = $domDoc;
        }

        private function getRootNode(): \DOMElement
        {
            return $this->dom->getElementsByTagName('catalog')->item(0);
        }

        public function processForm(): \DOMDocument
        {
            if ($this->request->has('submit')) {
                $this->setSearchedValues();
            } else {
                $this->setDefaultValues();
            }
            return $this->dom;
        }

        private function getDataType(): string
        {
            if ($this->request->get('sort') == 'price') {
                return 'number';
            } else {
                return 'text';
            }
        }

        private function setDefaultValues()
        {
            $root = $this->getRootNode();
            $root->setAttribute('sortby', 'author');
            $root->setAttribute('sortdatatype', 'text');
            $root->setAttribute('author', '');
            $root->setAttribute('title', '');
            $root->setAttribute('minprice', $this->xmlProcessor->getMinPrice());
            $root->setAttribute('maxprice', $this->xmlProcessor->getMaxPrice());
        }


        private function setSearchedValues()
        {
            $root = $this->getRootNode();
            $root->setAttribute('sortby', $this->request->get('sort'));
            $root->setAttribute('sortdatatype', $this->getDataType());
            $root->setAttribute('author', $this->request->get('author'));
            $root->setAttribute('title', $this->request->get('title'));
            $root->setAttribute('minprice', $this->request->get('minPrice'));
            $root->setAttribute('maxprice', $this->request->get('maxPrice'));
        }
    }
}
