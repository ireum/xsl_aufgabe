<?php


namespace library\routing
{


    class Uri
    {
        private $parts;

        public function __construct(string $uri)
        {
            $this->parts = parse_url($uri);
        }

        public function getPath(): string
        {
            return $this->parts['path'];
        }
    }
}
