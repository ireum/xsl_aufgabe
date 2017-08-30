<?php


namespace library\xmlhandler;


class XmlErrorGenerator
{

    /** @var string */
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function generateXml(array $errorFields, array $inputVariables)
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
                $field->nodeValue = $inputVariables[$field->nodeName];
            }
        }

        return $dom;

    }
}
