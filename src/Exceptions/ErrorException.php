<?php


namespace library\exceptions;


class ErrorException extends \Exception
{
    /** @var string */
    protected $message;
    /** @var int */
    protected $severity;
    /** @var string */
    protected $line;
    /** @var string */
    protected $file;

    public function __construct(string $message, int $severity, string $file, string $line)
    {
        $this->message = $message;
        $this->severity = $severity;
        $this->file = $file;
        $this->line = $line;
    }

    public function getSeverity()
    {
        return $this->severity;
    }
}
