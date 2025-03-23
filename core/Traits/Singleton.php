<?php

namespace Core\Traits;

trait Singleton
{
    private static $instance = null;

    public static function getInstance()
    {
        return static::$instance ?? (static::$instance = new static());
    }

    private function __construct() {}
}