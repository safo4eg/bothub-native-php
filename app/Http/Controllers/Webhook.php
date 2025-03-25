<?php

namespace App\Http\Controllers;

use Core\Http\Request;
use Core\Providers\TelegramServiceProvider;

class Webhook
{
    public function post(Request $request)
    {
        $telegramProvider = new TelegramServiceProvider();
        $telegramProvider->register();
        $telegramProvider->boot();
    }
}