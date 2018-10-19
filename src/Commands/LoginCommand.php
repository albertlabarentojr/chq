<?php
declare(strict_types=1);

namespace App\Commands;

class LoginCommand extends AbstractLogCommand
{
    /**
     * Log command name.
     *
     * @var string
     */
    protected static $defaultName = 'login';

    /**
     * Login exit message.
     *
     * @var string
     */
    protected static $exitMessage = 'Hey! Lazy boy, your LOGIN mail has been sent.';

    /**
     * Get log command name.
     *
     * @return string
     */
    public function getSubjectName(): string
    {
        return 'LOGIN';
    }
}
