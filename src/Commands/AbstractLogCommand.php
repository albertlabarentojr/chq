<?php
declare(strict_types=1);

namespace App\Commands;

use App\Services\Mail;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractLogCommand extends Command
{
    /**
     * Exit message after execution.
     *
     * @var string
     */
    protected static $exitMessage = 'Mail time log has been sent';

    /**
     * Get log command name.
     *
     * @return string
     */
    abstract public function getSubjectName(): string;

    /**
     * Configure log command.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->addOption(
            'datetime',
            null,
            InputOption::VALUE_OPTIONAL,
            'Time log with format DD/MM/YY',
            (new \DateTime())->format('d/m/y')
        );

        $this->addOption(
            'note',
            null,
            InputOption::VALUE_OPTIONAL,
            'Additional note will be added to the body (eg. CHQ Sorry I am late)',
            ''
        );
    }

    /**
     * Execute logout command.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     *
     * @throws \PHPMailer\PHPMailer\Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $body = $this->getBody($input);
        $subject = $this->getSubject($input);

        $mail = new Mail($body, $subject);

        $mail->send();

        $outputStyle = new OutputFormatterStyle('green');
        $output->getFormatter()->setStyle('msg', $outputStyle);

        $this->writeln(self::$exitMessage, $output);
        $this->writeln(\sprintf('SUBJECT: %s', $subject), $output);
        $this->writeln(\sprintf('<msg>' . 'BODY: %s', $body), $output);
    }

    /**
     * Get mail body.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @return string
     */
    private function getBody(InputInterface $input): string
    {
        return ' ';
    }

    /**
     * Get mail subject.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @return string
     */
    private function getSubject(InputInterface $input): string
    {
        return \sprintf('%s %s', $this->getSubjectName(), $input->getOption('datetime'));
    }

    /**
     * Formatted line output.
     *
     * @return void
     *
     * @param string $message
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    private function writeln(string $message, OutputInterface $output): void
    {
        $output->writeln('<msg>' . $message . '</>');
    }
}
