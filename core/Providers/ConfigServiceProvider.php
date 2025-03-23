<?php

namespace Core\Providers;

use Core\Configuration\Config;
use Dotenv\Dotenv;

class ConfigServiceProvider
{
    public function register(): void
    {
        $dotenv = Dotenv::createImmutable(base_path());
        $dotenv->load();

        $config = new Config();
        $files = glob(base_path('/config/*.php'));

        foreach ($files as $file) {
            $key = basename($file, '.php');
            $config->add(
                key: $key,
                array: require_once $file
            );
        }
    }

    public function boot(): void
    {
        //
    }
}