<?php

namespace library\requests
{


    use library\routing\Uri;

    abstract class AbstractRequest
    {
        /** @var array */
        private $inputVariables;
        /** @var array */
        private $server;

        public function __construct(array $inputVariables, array $server)
        {
            $this->inputVariables = $inputVariables;
            $this->server = $server;
        }

        public function has(string $key): bool
        {
            return isset($this->inputVariables[$key]);
        }

        public function get(string $key): string
        {
            if (!$this->has($key)) {
                return "";
            }
            return $this->inputVariables[$key];
        }

        public function getInputVariables()
        {
            return $this->inputVariables;
        }

        public function getUri(): Uri
        {
            return new Uri($this->server['REQUEST_URI']);
        }
    }
}
