<?php

namespace library\requests
{


    use library\routing\Uri;

    abstract class AbstractRequest
    {
        /** @var array */
        private $inputVariables;

        public function __construct(array $inputVariables)
        {
            $this->inputVariables = $inputVariables;
        }

        public function has(string $key): bool
        {
            return isset($this->inputVariables[$key]);
        }

        public function get(string $key): string
        {
            if (!$this->has($key)) {
                return "";
//                throw new \InvalidArgumentException(sprintf('Key "%s" not found', $key));
            }
            return $this->inputVariables[$key];
        }

        public function getUri(): Uri
        {
            return new Uri($_SERVER['REQUEST_URI']);
        }

        // TODO: Remove Method
//        public function getPath(): string
//        {
//            return $_SERVER['REQUEST_URI'];
//        }
    }
}
