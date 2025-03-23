<?php

namespace Core\Routing;

class RouteContext
{
    private static array $context = [];

    public static function save(array $context): void
    {
        self::$context = array_merge(self::$context, $context);
    }

    public static function get(string $key): mixed
    {
        return self::$context[$key] ?? null;
    }

    public static function clear(): void
    {
        self::$context = [];
    }
}