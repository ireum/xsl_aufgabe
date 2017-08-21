<?php


namespace library;


abstract class AbstractRequest
{
    /** @var array  */
    private $inputVariables;

    public function __construct(array $inputVariables)
    {
        $this->inputVariables = $inputVariables;
    }

    public function has(string $key)
    {
        return isset($this->inputVariables[$key]);
    }

    public function get(string $key)
    {
        if (!$this->has($key)) {
            throw new \RuntimeException(sprintf('Key "%s" not found', $key));
        }
        return $this->inputVariables[$key];
    }
}
