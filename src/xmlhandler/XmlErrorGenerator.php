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
            if (array_key_exists($field->nodeName, $errorFields)) {
                $dom->getElementsByTagName($field->nodeName)->item(0)->setAttribute('invalidField', 'true');
                $dom->getElementsByTagName($field->nodeName)->item(0)->nodeValue = $errorFields[$field->nodeName];
            } else {
                $dom->getElementsByTagName($field->nodeName)->item(0)->nodeValue = $inputVariables[$field->nodeName];
            }
        }
        return $dom;

    }
}
