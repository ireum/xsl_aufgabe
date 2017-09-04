<?php


namespace library
{

    use library\exceptions\ErrorException;

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
            $this->isValidIniFile($path);
                $this->configuration = parse_ini_file($path, true);
        }


        private function isValidIniFile(string $path)
        {
            set_error_handler(
                create_function(
                    '$severity, $message, $file, $line',
                    'throw new library\exceptions\ErrorException($message, $severity, $severity, $file, $line);'
                )
            );
            parse_ini_file($path, true, INI_SCANNER_TYPED);
            restore_error_handler();
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
