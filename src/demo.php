<?php
///formData/fields[name()]/*
///
$arr = ['author', 'title', 'genre', 'price', 'releaseDate', 'description'];

$dom = new DOMDocument();
$dom->load(__DIR__ . '/pages/add.xml');
$xpath = new DOMXPath($dom);

$fields = $xpath->query('/formData/fields/*');
foreach ($fields as $field) {
    echo($field->nodeName);
}

$dom->save(__DIR__ . '/pages/add.xml');
