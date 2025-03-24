<?php

namespace Core\Http;

class Request
{
    public function __construct(
        private string $method,
        private string $uri,
        private string $body
    )
    {}

    public function method(): string
    {
        return $this->method;
    }

    public function uri(): string
    {
        return $this->uri;
    }
}