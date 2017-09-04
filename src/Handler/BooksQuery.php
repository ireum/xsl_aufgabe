<?php

namespace library\handler
{
    class BooksQuery
    {
        /** @var \SimpleXMLElement */
        private $sXmlElement;

        public function __construct(string $path)
        {
            $this->setSxmlElement($path);
        }

        private function setSxmlElement(string $path)
        {
            $this->isValidIniFile($path);
            $this->sXmlElement = simplexml_load_file($path);
        }
        private function isValidIniFile(string $xmlPath)
        {
            set_error_handler(
                create_function(
                    '$severity, $message, $file, $line',
                    'throw new library\exceptions\ErrorException($message, $severity, $severity, $file, $line);'
                )
            );
            parse_ini_file($xmlPath, true, INI_SCANNER_TYPED);
            restore_error_handler();
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
            return 'bk' . ++$nextId;
        }
    }
}
