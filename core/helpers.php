<?php
use Core\App;

function base_path(string $path = ''): string
{
    return dirname(__DIR__) . $path;
}

/**
 * Получение экземпляра контейнера
 * @param string $key
 * @return void
 */
function app(): App
{
    return App::getInstance();
}