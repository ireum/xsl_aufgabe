<?php


namespace library\exceptions
{


    class InvalidBookException extends \InvalidArgumentException
    {
        /** @var array */
        private $errorFields;

        public function __construct(string $message, array $errorFields)
        {
            parent::__construct($message, 0, null);
            $this->errorFields = $errorFields;
        }

        public function getErrorFields(): array
        {
            return $this->errorFields;
        }

    }
}
