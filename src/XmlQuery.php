<?php

namespace library
{
    //TODO: X   Besserer Name (nicht Processor)
    class XmlQuery
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
    }
}
