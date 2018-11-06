<?php
declare(strict_types=1);

namespace Tests\App;

use App\Kernel;
use phpDocumentor\Reflection\Types\Parent_;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

class TestCase extends KernelTestCase
{
    protected $app;

    public function __construct()
    {
        $kernel = static::createKernel();
        $this->app = new Application($kernel);

        parent::__construct();
    }

    public function commandTester(Command $command, ?array $options = null): CommandTester
    {
        $commandTester = new CommandTester($command);

        $commandTester->execute(['command' => $command->getName()] + $options ?? []);

        return $commandTester;
    }
}
