<?php

namespace Core\Providers;

use Doctrine\DBAL\DriverManager;

class DatabaseServiceProvider
{
    public function register()
    {
        $dbParams = config('database.connections');
        app()->set('db', DriverManager::getConnection($dbParams));
    }

    public function boot()
    {

    }
}