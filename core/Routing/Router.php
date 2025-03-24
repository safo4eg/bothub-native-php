<?php

namespace Core\Routing;

class Router
{
    private array $routes = [];

    public function post(string $uri, array $handler, string $group): void
    {
        $config = new RouteConfig();
        $config->method = 'POST';
        $config->uri = $this->prepareUriSaving($uri, $group);
        $config->group = $group;
        $config->handler = $handler;

        $this->add($config);
    }

    public function get(string $uri, array $handler, string $group): void
    {
        $config = new RouteConfig();
        $config->method = 'GET';
        $config->uri = $this->prepareUriSaving($uri, $group);
        $config->group = $group;
        $config->handler = $handler;

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

    private function prepareUriSaving(string $uri, string $group): string
    {
        $prefix = config("route.groups.$group.prefix");
        return $prefix ? "/$prefix$uri" : $uri;
    }
}