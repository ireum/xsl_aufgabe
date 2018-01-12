<?php


namespace library
{

    class SearchFormProcessor
    {
        /** @var AbstractRequest */
        private $request;
        /** @var \SimpleXMLElement */
        private $sxmlElement;
        /** @var XmlProcessor */
        private $xmlProcessor;

        public function __construct(string $path, AbstractRequest $request, XmlProcessor $xmlProcessor)
        {
            $this->request = $request;
            $this->sxmlElement = $this->setSxmlElement($path);
            $this->xmlProcessor = $xmlProcessor;
        }

        private function setSxmlElement(string $path)
        {
            if (!simplexml_load_file($path)) {
                throw new \InvalidArgumentException('Invalid path');
            }
            return simplexml_load_file($path);
        }

        public function getSxmlElement(): \SimpleXMLElement
        {
            return $this->sxmlElement;
        }

        public function processForm()
        {
            if ($this->request->has('submit')) {
                $this->setSearchedValues();
            } else {
                $this->setDefaultValues();
            }
        }

        private function setDefaultValues()
        {
            $this->sxmlElement->addAttribute('sortby', 'author');
            $this->sxmlElement->addAttribute('sortdatatype', 'text');
            $this->sxmlElement->addAttribute('author', '');
            $this->sxmlElement->addAttribute('title', '');
            $this->sxmlElement->addAttribute('minprice', $this->xmlProcessor->getMinPrice());
            $this->sxmlElement->addAttribute('maxprice', $this->xmlProcessor->getMaxPrice());
        }

        private function setSearchedValues()
        {
            $this->sxmlElement->addAttribute('sortby', $this->request->get('sort'));
            $this->sxmlElement->addAttribute('sortdatatype', $this->getDataType());
            $this->sxmlElement->addAttribute('author', $this->request->get('author'));
            $this->sxmlElement->addAttribute('title', $this->request->get('title'));
            $this->sxmlElement->addAttribute('minprice', $this->request->get('minPrice'));
            $this->sxmlElement->addAttribute('maxprice', $this->request->get('maxPrice'));
        }

        private function getDataType(): string
        {
            if ($this->request->get('sort') == 'price') {
                return 'number';
            } else {
                return 'text';
            }
        }
    }
}
