<?php
declare(strict_types=1);

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class SetupCommand extends Command
{
    /**
     * Setup command name.
     *
     * @var string
     */
    protected static $defaultName = 'configure';

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        // TODO set environment using questions
        $helper = $this->getHelper('question');
        $question = new Question('What is your company email address? ', false);
        $email = $helper->ask($input, $output, $question);
        $output->writeln($email);
    }
}
