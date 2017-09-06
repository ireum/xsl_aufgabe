<?php


namespace library\exceptions;


class ErrorException extends \Exception
{
    /** @var string */
    protected $message;
    /** @var int */
    protected $severity;

    public function __construct(string $message, int $severity)
    {
        parent::__construct($message);
        $this->severity = $severity;
    }

    public function getSeverity()
    {
        return $this->severity;
    }
}
