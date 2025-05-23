<?php

return [
    'connections' => [
        'dbname' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'host' => $_ENV['DB_HOST'],
        'driver' => $_ENV['DB_DRIVER'],
    ],

    'migrations' => [
        'table_storage' => [
            'table_name' => 'doctrine_migration_versions',
        ],

        'migrations_paths' => [
            'namespace' => 'Database\Migrations',
            'path' => base_path('/migrations')
        ],

        'all_or_nothing' => true,
        'transactional' => true,
        'check_database_platform' => true,
        'organize_migrations' => 'none',
        'connection' => null,
        'em' => null
    ]
];