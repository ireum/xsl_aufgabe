<?php


namespace library;


class Uri
{
    private $parts;

    public function __construct(string $uri)
    {
        $this->parts = parse_url($uri);
    }

    public function getPath(): string
    {
        return $this->parts['path'];
    }

//    public function getParameter(string $key)
//    {
//        return $this->parts['query'];
//    }
}
