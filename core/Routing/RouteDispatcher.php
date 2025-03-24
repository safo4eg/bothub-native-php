<?php

namespace Core\Routing;

use Core\Http\Request;
use JetBrains\PhpStorm\Pure;

class RouteDispatcher
{
    public Router $router;
    public Request $request;
    public function __construct()
    {
        $this->router = app()->get('router');
        $this->request = app()->get('request');
    }

    public function dispatch()
    {
        foreach ($this->router->getRoutes() as $route)
        {
            if(
                $route->method === $this->request->method()
                && $route->uri === $this->request->uri()
            )
            {
                [$class, $method] = $route->handler;

                if(!class_exists($class)) {
                    throw new \Exception("Controller $class not found");
                }

                if(!method_exists($class, $method)) {
                    throw new \Exception("Controller $class does not have method $method");
                }

                // запуск мидлваров

                // запуск действия контроллера
                return call_user_func([new $class(), $method], $this->request);
            }
        }

        // маршрут не найден
        http_response_code(404);
        echo '404 Not Found';
        exit;
    }
}