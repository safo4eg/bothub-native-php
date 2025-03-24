<?php

namespace Core;

use Core\Http\Request;
use Core\Providers\ConfigServiceProvider;
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
        $request = new Request(
            method: $_SERVER['REQUEST_METHOD'],
            uri: $_SERVER['REQUEST_URI'],
            body: file_get_contents('php://input')
        );
        $this->set('request', $request);


        // запуск провайдеров
        foreach ($providers as $provider)
        {
            $registeredProvider->boot();
        }
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