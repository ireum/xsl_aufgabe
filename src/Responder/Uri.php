<?php


namespace library\responder
{


    class Uri
    {
        private $parts;

        public function __construct(string $uri)
        {
            $this->parts = parse_url($uri);
        }

        private function hasPath(): bool
        {
            return isset($this->parts['path']);
        }

        public function getPath(): string
        {
            if ($this->hasPath()) {
                return $this->parts['path'];
            } else {
                throw new \RuntimeException('Path is not set');
            }
        }
    }
}
