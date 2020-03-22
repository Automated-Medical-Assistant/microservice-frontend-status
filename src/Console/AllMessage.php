<?php declare(strict_types=1);

namespace App\Console;

use App\DataTransferObject\TestDataProvider;
use App\Redis\RedisServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class AllMessage extends Command
{
    protected static $defaultName = 'test:all:message';

    /**
     * @var \App\Redis\RedisServiceInterface
     */
    private RedisServiceInterface $redisService;


    public function __construct(RedisServiceInterface $redisService)
    {

        parent::__construct();
        $this->redisService = $redisService;
    }

    protected function configure()
    {
        $this->setDescription('Test message');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        dump($this->redisService->getAll());

        return 0;
    }
}
