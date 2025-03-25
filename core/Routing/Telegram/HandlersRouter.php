<?php

namespace Core\Routing\Telegram;

use TelegramBot\Api\Client;
use \TelegramBot\Api\Types\Update;

class HandlersRouter
{
    private Client $client;
    private array $routes = [];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function onMessage(string $handlerClass): HandlerConfig
    {
        $config = new HandlerConfig();
        $config->handler = $handlerClass;
        $config->type = HandlerTypeEnum::ON_MASSAGE;
        $this->add($config);
        return $config;
    }

    public function run(): void
    {
        foreach ($this->routes as $route)
        {
            $middlewares = [];

            foreach ($route->middlewares as $middleware)
            {
                $middlewares[] = new $middleware();
            }

            if($route->type->value === HandlerTypeEnum::ON_MASSAGE->value)
            {
                $filterHandler = function (Update $update) {
                    $message = $update->getMessage();
                    return $message && $message->getText();
                };
                $mainHandler = new $route->handler;

                $onMessageHandler = null;

                if(count($middlewares) > 0) {
                    $func = function ($next, $middleware) {
                        return function (Update $update) use ($next, $middleware) {
                            return $middleware($next, $update, $this->client);
                        };
                    };

                    $onMessageHandler = array_reduce($route->middlewares, $func, $mainHandler);
                } else {
                    $onMessageHandler = function (Update $update) use($mainHandler) {
                        return $mainHandler($update, $this->client);
                    };
                }

                $this->client->on($onMessageHandler, $filterHandler);
            }
        }

        $this->client->run();
    }

    private function add(HandlerConfig $config): void
    {
        $this->routes[] = $config;
    }
}