<?php


namespace library\routing
{

    class Session
    {
        /** @var array */
        private $inputVariables;

        public function __construct()
        {
        }

        public function set(array $inputVariables)
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
                throw new \InvalidArgumentException(sprintf('Key "%s" not found', $key));
            }
            return $this->inputVariables[$key];
        }
    }
}
