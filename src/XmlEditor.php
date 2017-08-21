<?php


namespace library
{
    class XmlEditor
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
    }
}
