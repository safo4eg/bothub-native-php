<?php

namespace App\Telegram\Middlewares;

class EnsureUserMiddleware
{
    public function __invoke($next, $update, $bot)
    {

        $next($update, $bot);
    }
}