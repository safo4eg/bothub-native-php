<?php

namespace Core\Providers;

use Core\Exceptions\ErrorHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class LogServiceProvider
{
    public function register(): void
    {
        $logger = (new Logger('project'))
            ->pushHandler(new StreamHandler(base_path('/storage/logs/bot.logs'), Level::Info));

        app()->set('logger', $logger);

        (new ErrorHandler())->registerHandlers();
    }

    public function boot()
    {

    }
}