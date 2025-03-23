<?php

namespace App;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Throwable;

class ErrorHandler
{
    private Logger $logger;
    public function __construct(string $logPath)
    {
        $baseLogPath = base_path() . $logPath;

        $logger = (new Logger('app_name'))
            ->pushHandler(new StreamHandler($baseLogPath, Level::Info));

        $this->logger = $logger;

        $this->registerHandlers();
    }

    public function registerHandlers(): void
    {
        set_exception_handler([$this, 'handleException']);

        set_error_handler([$this, 'handleError']);
    }

    public function handleException(Throwable $e): void
    {
        $this->logger->info(message: 'Uncaught Exception', context: [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTrace()
        ]);

        echo "Произошла ошибка, администратор уже в курсе."; // 404 по идее
    }

    public function handleError(int $errno, string $errstr, string $errfile, int $errline): void
    {
        throw new \ErrorException(
            message: $errstr,
            code: 0,
            severity: $errno,
            filename: $errfile,
            line: $errline
        );
    }

}