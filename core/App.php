<?php

namespace Core;

use Core\Http\Request;
use Core\Providers\ConfigServiceProvider;
use Core\Routing\RouteDispatcher;
use Core\Traits\Singleton;
use Core\Providers\RouteServiceProvider;

class App
{
    use Singleton;

    private array $instances = [];

    /*
     * Регистрация провайдеров от более важных
     */
    private array $providers = [
        ConfigServiceProvider::class,
        RouteServiceProvider::class
    ];

    public function run(): void
    {
        $providers = [];

        // регистрация провайдеров
        foreach($this->providers as $provider)
        {
            $registeredProvider = new $provider;
            $registeredProvider->register();
            $providers[] = $registeredProvider;
        }

        // создание объекта request
        $this->set('request', new Request(
            method: strtoupper($_SERVER['REQUEST_METHOD']),
            uri: $_SERVER['REQUEST_URI'],
            body: file_get_contents('php://input')
        ));

        // можно добавить проверку глобальных middleware

        // запуск провайдеров
        foreach ($providers as $provider)
        {
            $registeredProvider->boot();
        }

        // сопоставление запроса с маршрутом и вызов контроллера
        $dispatcher = new RouteDispatcher();
        $dispatcher->dispatch();
    }

    /**
     * Добавление сервиса в контейнер и возврат его инстанса
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function set(string $key, mixed $value): void
    {
        $this->instances[$key] = $value;
    }

    public function get(string $key): mixed
    {
        if(isset($this->instances[$key])) {
            return $this->instances[$key];
        }

        return new \Exception("Service $key not found.");
    }
}