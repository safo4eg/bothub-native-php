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

function config(string $key, mixed $default = null): mixed
{
    $config = app()->get('config');

    return $config->get($key, $default);
}

function logger()
{
    return app()->get('logger');
}