<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'layout:start')]
class LayoutCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $appName = config('app.name');

        $output->writeln("$appName");

        return Command::SUCCESS;
    }
}