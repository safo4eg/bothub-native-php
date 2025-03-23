<?php

namespace Core\Facades;

use Core\Routing\RouteContext;

class Route
{
    public static function post(string $uri, array $handler): void
    {
        app()->get('router')->post(
            uri: $uri,
            handler: $handler,
            group: RouteContext::get('group')
        );
    }
}