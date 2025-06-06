<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TelegramBot\Api\BotApi;

#[AsCommand(name: 'webhook:set')]
class SetWebhookCommand extends Command
{
    protected function configure(): void
    {
        $this->setDescription('Установить вебхук')
            ->addArgument('url', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $token = config('telegram.token');
            $bot = new BotApi($token);
            $url = $input->getArgument('url');
            $bot->setWebhook($url);
            $output->writeln("Вебхук установлен на $url");
            return Command::SUCCESS;
        } catch (\Throwable $e) {
            return Command::FAILURE;
        }
    }
}