<?php

namespace Core\Routing\Telegram;

class HandlerConfig
{
    public string $handler = '';
    public array $middlewares = [];

    public HandlerTypeEnum $type;

    public function middlewares(array $middlewares)
    {
        $this->middlewares = $middlewares;
    }
}