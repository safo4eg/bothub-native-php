<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use TelegramBot\Api\BotApi;
#[AsCommand(name: 'webhook:remove')]
class RemoveWebhookCommand extends Command
{
    protected function configure(): void
    {
        $this->addOption(
            name: 'drop-pending-updates',
            shortcut: null,
            mode: InputOption::VALUE_OPTIONAL,
            description: '',
            default: false
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $token = config('telegram.token');
            $bot = new BotApi($token);
            $dropPendingUpdates = $input->getOption('drop-pending-updates');
            $bot->deleteWebhook($dropPendingUpdates);

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            return Command::FAILURE;
        }
    }
}