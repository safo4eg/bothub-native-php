<?php

namespace Core\Providers;

use Symfony\Component\Console\Application;

class ConsoleServiceProvider
{
    public function register(): void
    {
        $console = new Application(config('app.name'));
        app()->set('console', $console);
    }

    public function boot(): void
    {
        require_once config('route.groups.console.path');
    }
}