<?php

declare(strict_types=1);

namespace App\Logging\Telegram;

use App\Services\Telegram\TelegramBotApi;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger;

final class TelegramLoggerHandler extends AbstractProcessingHandler implements HandlerInterface
{
    private string $token;
    private int $chatId;

    public function __construct(array $config)
    {
        $level = Logger::toMonologLevel($config['level']);

        parent::__construct($level);

        $this->token = $config['token'];
        $this->chatId = $config['chat_id'];
    }

    protected function write(array $record): void
    {
        // $record['formatted']

        TelegramBotApi::sendMessage($this->token, $this->chatId, $record['formatted']);
    }
}
