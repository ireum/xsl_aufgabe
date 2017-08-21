<?php


namespace library
{

    class OutPutPreparer
    {
        public function __construct(string $path)
        {

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
