<?php

namespace App\Telegram\Middlewares;

/**
 * Проверка на наличие записи пользователя в БД
 * только для текстовых (по хорошему вынести в обработчик onCommand('start'))
 */

class EnsureUserMiddleware
{
    public function __invoke($next, $update, $bot)
    {
        $db = app()->get('db');
        $chatId = $update->getMessage()->getChat()->getId();
        $user = $db->fetchAssociative('SELECT * FROM users WHERE id = ?', [$chatId]);

        $db->beginTransaction();
        try {
            if(!$user) {
                $db->executeStatement('INSERT INTO users (id) VALUES (?)', [$chatId]);
            }
            $db->commit();
        } catch (\Throwable $e) {
            $db->rollBack();
            throw $e;
        }

        $next($update, $bot);
    }
}