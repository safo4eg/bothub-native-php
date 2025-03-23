<?php

namespace Core\Providers;

use Core\Routing\RouteContext;
use Core\Routing\Router;

class RouteServiceProvider
{
    public function register(): void
    {
        app()->set('router', new Router());
    }

    public function boot(): void
    {
        self::loadApiRoutes();
    }

    private function loadApiRoutes(): void
    {
        RouteContext::save(['group' => 'api']);
        require_once base_path('/routes/api.php');
        RouteContext::clear();
    }
}