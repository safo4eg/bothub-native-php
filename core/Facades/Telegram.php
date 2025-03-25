<?php

namespace Core\Facades;

use Core\Routing\Telegram\HandlerConfig;

class Telegram
{
    public static function onMessage(string $handlerClass): HandlerConfig
    {
        return app()->get('telegramRouter')
            ->onMessage($handlerClass);
    }
}