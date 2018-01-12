<?php

namespace library
{
    class XmlProcessor
    {
        /** @var \SimpleXMLElement */
        private $sxmlElement;

        public function __construct(string $path)
        {
            $this->sxmlElement = $this->setSxmlElement($path);
        }

        private function setSxmlElement(string $path)
        {
            if (!simplexml_load_file($path)) {
                throw new \InvalidArgumentException('Invalid path');
            }
            return simplexml_load_file($path);
        }

        public function getMinPrice(): float
        {
            $prices = $this->sxmlElement->xpath('//catalog/book/price');
            sort($prices, SORT_NUMERIC);
            return floatval($prices[0]);
        }

        public function getMaxPrice(): float
        {
            $prices = $this->sxmlElement->xpath('//catalog/book/price');
            sort($prices, SORT_NUMERIC);
            return floatval(end($prices));
        }

        public function getNextId(): string
        {
            $lastId = $this->sxmlElement->xpath('//catalog/book[last()]/@id')[0][0];
            $nextId = substr($lastId, 2);
            return 'bk' . ++$nextId;
        }

        public function getAuthors()
        {
            return array_unique(
                $this->sxmlElement->xpath('//catalog/book/author'),
                SORT_STRING
            );
        }

        public function getSortTypes()
        {
            return $this->sxmlElement->xpath('/catalog/book[1]/*');
        }


        public function getRootElementByName(string $root): \SimpleXMLElement
        {
            return $this->sxmlElement->xpath('/' . $root)[0];
        }
    }
}
