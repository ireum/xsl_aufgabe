<?php

namespace library\handler
{
    class BooksQuery
    {
        /** @var \SimpleXMLElement */
        private $sXmlElement;

        public function __construct(string $path)
        {
            $this->sXmlElement = $this->setSxmlElement($path);
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
            $prices = $this->sXmlElement->xpath('//catalog/book/price');
            sort($prices, SORT_NUMERIC);
            return floatval($prices[0]);
        }

        public function getMaxPrice(): float
        {
            $prices = $this->sXmlElement->xpath('//catalog/book/price');
            sort($prices, SORT_NUMERIC);
            return floatval(end($prices));
        }

        public function getNextId(): string
        {
            $lastId = $this->sXmlElement->xpath('//catalog/book[last()]/@id')[0][0];
            $nextId = substr($lastId, 2);
            echo $nextId . PHP_EOL;
            return 'bk' . ++$nextId;
        }
    }
}
