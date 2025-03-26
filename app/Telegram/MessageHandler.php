<?php

namespace App\Telegram;

use App\Helpers\MoneyHelper;
use \TelegramBot\Api\Types\Update;
use \TelegramBot\Api\Client;

class MessageHandler
{
    public function __invoke(Update $update, Client $bot)
    {
        $db = app()->get('db');

        $message = $update->getMessage();
        $chatId = $message->getChat()->getId();
        $user = $db->fetchAssociative('SELECT * FROM users WHERE id=?', [$chatId]);

        $text = $message->getText();

        if(!preg_match('/^-?\d+(?:[.,]\d+)?$/u', $text)) {
            $bot->sendMessage($chatId, 'Некорректное сообщение');
            return;
        }

        $text = str_replace(',', '.', $text);
        $startWithMinus = str_starts_with($text, '-');
        $text = $startWithMinus ? mb_substr($text, 1): $text;
        $cents = MoneyHelper::fromDollarsToCents($text);

        if($startWithMinus && (int) $user['balance'] < (int) $cents) {
            $bot->sendMessage($chatId, 'Недостаточное количество средств для вычитания.');
            return;
        }

        $newBalance = 0;
        if($startWithMinus) {
            $newBalance = (int) $user['balance'] - (int) $cents;
        } else {
            $newBalance = (int) $user['balance'] + (int) $cents;
        }

        $db->beginTransaction();
        try {
            $db->executeStatement(
                'UPDATE users SET balance = ? WHERE id = ?',
                [$newBalance, $chatId]
            );
            $db->commit();

            $dollars = MoneyHelper::fromCentsToDollars($newBalance);
            $bot->sendMessage($chatId, "Ваш баланс $dollars$");
        } catch (\Throwable $e) {
            $db->rollBack();
            $bot->sendMessage($chatId, 'Произошла ошибка, попробуйте снова.');
            return;
        }
    }
}