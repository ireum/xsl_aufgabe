<?php

namespace library\processor
{

    use library\backends\FileBackend;
    use library\requests\AbstractRequest;
    use library\responder\HtmlResponse;
    use library\session\Session;

    class DisplayBookFormProcessor implements Processor
    {

        /** @var string */
        private $xmlPath;
        /** @var string */
        private $xslPath;
        /** @var Session */
        private $session;
        /** @var FileBackend */
        private $fileBackend;

        public function __construct(string $xmlPath, string $xslPath, Session $session, FileBackend $fileBackend)
        {
            $this->xmlPath = $xmlPath;
            $this->xslPath = $xslPath;
            $this->session = $session;
            $this->fileBackend = $fileBackend;
        }

        public function execute(
            HtmlResponse $response,
            AbstractRequest $request
        )
        {
            $xslParser = new \XSLTProcessor();
            $xslParser->importStylesheet(simplexml_load_file($this->xslPath));

            $dom = new \DOMDocument();
            if ($this->session->hasError()) {
              $dom = $this->session->getErrorXml();

            } else {
                $dom->loadXML($this->fileBackend->load($this->xmlPath)); //TODO: X Via FileBAckend
            }
            $response->setBody($xslParser->transformToDoc($dom)->saveXML());
            $this->session->resetErrorXml();
        }

    }
}

