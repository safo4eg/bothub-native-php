<?php

namespace Core\Providers;

use Doctrine\Migrations\Configuration\Configuration;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\Configuration\Migration\ExistingConfiguration;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Metadata\Storage\TableMetadataStorageConfiguration;

class MigrationServiceProvider
{
    public function register(): void
    {
        $migrationsParams = config('database.migrations');
        $connection = app()->get('db');

        $configuration = new Configuration($connection);
        $configuration->addMigrationsDirectory(
            namespace: $migrationsParams['migrations_paths']['namespace'],
            path: $migrationsParams['migrations_paths']['path']
        );
        $configuration->setAllOrNothing($migrationsParams['all_or_nothing']);
        $configuration->setTransactional($migrationsParams['transactional']);
        $configuration->setCheckDatabasePlatform($migrationsParams['check_database_platform']);
        $configuration->setMigrationOrganization($migrationsParams['organize_migrations']);
        $configuration->setConnectionName($migrationsParams['connection']);
        $configuration->setEntityManagerName($migrationsParams['em']);

        $storageConfiguration = new TableMetadataStorageConfiguration();
        $storageConfiguration->setTableName($migrationsParams['table_storage']['table_name']);

        $configuration->setMetadataStorageConfiguration($storageConfiguration);

        $dependencyFactory = DependencyFactory::fromConnection(
            new ExistingConfiguration($configuration),
            new ExistingConnection($connection)
        );

        app()->set('migrationDependencyFactory', $dependencyFactory);
    }

    public function boot(): void
    {

    }
}