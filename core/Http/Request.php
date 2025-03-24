<?php

namespace Core\Http;

class Request
{
    public function __construct(
        public readonly string $method,
        public readonly string $uri,
        public readonly string $body
    )
    {}
}