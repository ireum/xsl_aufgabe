<?php


namespace library\handler;


use library\backends\FileBackend;
use library\requests\AbstractRequest;

class ErrorXmlGenerator
{

    /** @var string */
    private $path;
    /** @var FileBackend */
    private $fileBackend;

    public function __construct(string $path, FileBackend $fileBackend)
    {
        $this->path = $path;
        $this->fileBackend = $fileBackend;
    }

    public function generateXml(array $errorFields, AbstractRequest $request): \DOMDocument
    {
        $dom = new \DOMDocument();
        $dom->loadXML($this->fileBackend->load($this->path)); //TODO: X Via FileBAckend

        $xpath = new \DOMXPath($dom);
        $fields = $xpath->query('/formData/fields/*');
        foreach ($fields as $field) {
            /** @var $field \DOMElement */
            if (array_key_exists($field->nodeName, $errorFields)) {
                $field->setAttribute('invalidField', 'true');
                $field->nodeValue = $errorFields[$field->nodeName];
            } else {
//                $field->nodeValue = $inputVariables[$field->nodeName];
                $field->nodeValue = $request->get($field->nodeName);
            }
        }
        return $dom;
    }
}
