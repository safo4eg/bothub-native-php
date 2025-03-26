<?php

use \Core\Facades\Telegram;
use \App\Telegram\MessageHandler;
use \App\Telegram\Middlewares\EnsureUserMiddleware;
use \App\Telegram\Middlewares\TestMiddleware;

Telegram::onMessage(MessageHandler::class)
    ->middlewares([EnsureUserMiddleware::class]);