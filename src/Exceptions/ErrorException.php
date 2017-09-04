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

    public function __construct(string $message, int $severity)
    {
        parent::__construct($message);
        //TODO: X Parent aufrufen, Reihenfolge der Argumente beibehalten, neue Argumente am schluss
//        $this->message = $message;
        $this->severity = $severity;
    }

    public function getSeverity()
    {
        return $this->severity;
    }
}
