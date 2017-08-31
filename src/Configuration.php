<?php


namespace library
{

    class Configuration
    {
        /** @var array */
        private $configuration;

        public function __construct(string $path)
        {
            $this->setConfiguration($path);
        }

        private function setConfiguration(string $path)
        {
            if ($this->isValidIniFile($path)) {
                $this->configuration = parse_ini_file($path, true);
            }
        }

        private function isValidIniFile(string $path): bool
        {
            if (parse_ini_file($path, true, INI_SCANNER_TYPED) === false) {
                throw new \InvalidArgumentException('invalid ini file: ' . $path);
            }
            return true;
        }

        public function getXmlPath(): string
        {
            return __DIR__ . '/../data/' . $this->configuration['xmlPath'];
        }

        public function getXslPath(): string
        {
            return __DIR__ . '/../xsl/' . $this->configuration['xslPath'];
        }

        public function getXmlAddBookPath(): string
        {
            return __DIR__ . '/../data/' . $this->configuration['xmlAddBookPath'];
        }

        public function getXslAddBookPath(): string
        {
            return __DIR__ . '/../xsl/add.xsl';
        }

    }
}