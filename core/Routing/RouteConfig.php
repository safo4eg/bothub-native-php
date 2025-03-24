<?php

namespace Core\Routing;

class RouteConfig
{
    public function __construct(
        public readonly string $method,
        public readonly string $uri,
        public readonly array $handler,
        public readonly string $group
    )
    {}
}