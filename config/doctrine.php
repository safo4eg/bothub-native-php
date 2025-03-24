<?php

return [
    'table_storage' => [
        'table_name' => 'doctrine_migrations'
    ],

    'migrations_paths' => [
        'Migrations' => base_path('migrations')
    ],

    'all_or_nothing' => true,

    'check_database_platform' => true,
];