<?php


namespace library\handler;


use library\requests\AbstractRequest;

class ErrorXmlGenerator
{

    /** @var string */
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function generateXml(array $errorFields, AbstractRequest $request): \DOMDocument
    {
        $dom = new \DOMDocument();
        $dom->load($this->path);

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
