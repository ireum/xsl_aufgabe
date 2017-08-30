<?php


namespace library\xmlhandler;


class XmlErrorGenerator
{

    public function __construct()
    {
    }

    public function generateXml(array $errorFields, array $inputVariables)
    {
        $dom = new \DOMDocument();
        $dom->load(__DIR__ . '/../pages/add.xml');

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
