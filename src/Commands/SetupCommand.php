<?php
declare(strict_types=1);

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
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
    protected static $defaultName = 'setup';

    /**
     * Configuration questions.
     *
     * @var string[]
     */
    private static $configurations = [
        'Company email' => ['MAIL_FROM_ADDRESS', 'MAIL_FROM_NAME', 'MAIL_USERNAME'],
        'Email password' => 'MAIL_PASSWORD',
        'Mail name' => 'MAIL_NAME',
        'Mail receiver' => 'MAIL_TO',
        'Mail carbon copy to' => 'MAIL_TO_CC'
    ];

    /**
     * Execute command
     *
     * @return void
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $outputStyle = new OutputFormatterStyle('green');
        $output->getFormatter()->setStyle('msg', $outputStyle);

        $this->defaultConfigInit();

        foreach (self::$configurations as $question => $config) {
            $helper = $this->getHelper('question');

            $questionObj = new Question($question . ' ', false);

            $answer = $helper->ask($input, $output, $questionObj);

            if (\is_string($config) === true) {
                $this->writeToEnv($config, $answer);
                continue;
            }

            /** @var string[] $config */
            foreach ($config as $configName) {
                $this->writeToEnv($configName, $answer);
            }
        }
    }

    /**
     * Write to environment file.
     *
     * @param string $configName
     * @param string $answer
     *
     * @return void
     */
    public function writeToEnv(string $configName, string $answer): void
    {
        $envPath = __DIR__ . '/../../.env';
        $contents = \file_get_contents($envPath);

        $contents .= "\n{$configName}={$answer}";

        if (empty(\getenv($configName)) === false) {
            $oldConfiguration = $configName . '=' . \getenv($configName);
            $contents = \str_replace($oldConfiguration, '', $contents);
        }

        $file = fopen($envPath, 'w');

        fwrite($file, preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $contents));
        fclose($file);
    }

    /**
     * Init default configuration.
     *
     * @return void
     */
    private function defaultConfigInit(): void
    {
        $config = [
            'MAIL_DRIVER' => 'smtp',
            'MAIL_HOST' => 'smtp.gmail.com',
            'MAIL_PORT' => 587,
            'MAIL_ENCRYPTION' => 'tls'
        ];

        foreach ($config as $name => $value) {
            $this->writeToEnv($name, $value);
        }
    }
}
