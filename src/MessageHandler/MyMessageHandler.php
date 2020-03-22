<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Redis\RedisServiceInterface;
use MessageInfo\NumberCreationRequestAPIDataProvider;

class MyMessageHandler
{
    private RedisServiceInterface $redisService;

    /**
     * @param \App\Redis\RedisServiceInterface $redisService
     */
    public function __construct(\App\Redis\RedisServiceInterface $redisService)
    {
        $this->redisService = $redisService;
    }
    public function __invoke(NumberCreationRequestAPIDataProvider $message)
    {
        try {
            $this->redisService->set((string)$message->getNumber(), json_encode($message->toArray()));
        } catch (\Throwable $e) {
            dump($e);
        }
    }
}
