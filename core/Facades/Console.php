<?php

namespace Core\Facades;

class Console
{
    public static function add(string $commandClass, array $args = [])
    {
        $command = new $commandClass(...$args);

        app()->get('console')->add($command);
    }

    /**
     * Множественная регистрация команд
     * ключ - имя команды, значение - массив аргументов
     * @param array $commands
     * @return void
     */
    public static function addCommands(array $commands): void
    {
        foreach ($commands as $commandName => $commandArgs) {
            self::add($commandName, $commandArgs);
        }
    }
}