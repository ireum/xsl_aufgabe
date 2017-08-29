<?php


namespace library\routing
{

    class Session
    {
        /** @var array */
        private $inputVariables;
        private $errorXml;

        public function __construct(array $inputVariables)
        {
            $this->inputVariables = $inputVariables;
        }

        public function set(string $key, $value)
        {
            $this->inputVariables[$key] = $value;
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

        public function resetErrorXml()
        {
            $this->errorXml = null;
        }

        public function hasErrorXml()
        {

        }

        public function generateErrorXml()
        {
            $cache = '<?xml version="1.0"?><?xml-stylesheet type="text/xsl" href="add.xsl"?>';
            $cache .= '<formerrors>';
            $cache .= '<field>';
            $cache .= '<invalidField>' . $this->get('invalidField') . '</invalidField>';
            $cache .= '<value>' . $this->get('invalidField') . '</value>';
            $cache .= '<invalidField>' . $this->get('invalidField') . '</invalidField>';
            $cache .= '</field>';
            $cache .= '</formerrors>';
        }

    }
}
