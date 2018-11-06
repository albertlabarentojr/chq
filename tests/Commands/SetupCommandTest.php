<?php
declare(strict_types=1);

namespace App\Tests\Commands;

use Tests\App\TestCase;

/**
 * @covers \App\Commands\SetupCommand
 */
class SetupCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $command = $this->app->find('setup');
        $commandTester = $this->commandTester($command);

        $this->assertContains('Email',  $commandTester->getDisplay());
    }
}


