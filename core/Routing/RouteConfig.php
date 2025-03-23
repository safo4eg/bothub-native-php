<?php

namespace Core\Routing;

class RouteConfig
{
    public function __construct(
        public string $method,
        public string $uri,
        public array $handler,
        public string $group
    )
    {}
}