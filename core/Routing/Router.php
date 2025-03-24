<?php

namespace Core\Routing;

class Router
{
    private array $routes = [];

    public function post(string $uri, array $handler, string $group): void
    {
        $config = new RouteConfig(
            method: 'POST',
            uri: $uri,
            group: $group,
            handler: $handler
        );

        $this->add($config);
    }

    public function get(string $uri, array $handler, string $group): void
    {
        $config = new RouteConfig(
            method: 'GET',
            uri: $uri,
            group: $group,
            handler: $handler
        );

        $this->add($config);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    private function add(RouteConfig $config): void
    {
        $this->routes[] = $config;
    }
}