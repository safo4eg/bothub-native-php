<?php

namespace Core\Providers;

use Core\Routing\Telegram\HandlersRouter;
use TelegramBot\Api\Client;

class TelegramServiceProvider
{
    public function register(): void
    {
        $botToken = config('telegram.token');

        $client = new Client($botToken);
        $handlersRouter = new HandlersRouter($client);
        app()->set('telegramRouter', $handlersRouter);
    }

    public function boot(): void
    {
        require_once base_path('/routes/telegram.php');
        app()->get('telegramRouter')
            ->run();
    }
}