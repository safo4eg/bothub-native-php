<?php

use \Core\Facades\Telegram;
use \App\Telegram\MessageHandler;

Telegram::onMessage(MessageHandler::class);