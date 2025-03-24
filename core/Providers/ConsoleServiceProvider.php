<?php

namespace Core\Providers;

use Core\Facades\Console;
use Symfony\Component\Console\Application;
use Doctrine\Migrations\Tools\Console\Command;

class ConsoleServiceProvider
{
    public function register(): void
    {
        $console = new Application(config('app.name'));
        app()->set('console', $console);
    }

    public function boot(): void
    {
        require_once config('route.groups.console.path');

        // регистрируем базовые команды
        $dependencyFactory = app()->get('migrationDependencyFactory');

        Console::addCommands([
            Command\CurrentCommand::class => [$dependencyFactory],
            Command\DiffCommand::class => [$dependencyFactory],
            Command\DumpSchemaCommand::class => [$dependencyFactory],
            Command\ExecuteCommand::class => [$dependencyFactory],
            Command\GenerateCommand::class => [$dependencyFactory],
            Command\LatestCommand::class => [$dependencyFactory],
            Command\ListCommand::class => [$dependencyFactory],
            Command\MigrateCommand::class => [$dependencyFactory],
            Command\RollupCommand::class => [$dependencyFactory],
            Command\StatusCommand::class => [$dependencyFactory],
            Command\SyncMetadataCommand::class => [$dependencyFactory],
            Command\UpToDateCommand::class => [$dependencyFactory],
            Command\VersionCommand::class => [$dependencyFactory],
        ]);
    }
}