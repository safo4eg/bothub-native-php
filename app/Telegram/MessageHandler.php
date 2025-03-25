<?php

namespace App\Telegram;

use \TelegramBot\Api\Types\Update;
use \TelegramBot\Api\Client;

class MessageHandler
{
    public function __invoke(Update $update, Client $bot)
    {
        $chatId = $update->getMessage()->getChat()->getId();
        $bot->sendMessage($chatId, 'hello world!');
    }
}