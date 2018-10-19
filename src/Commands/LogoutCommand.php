<?php
declare(strict_types=1);

namespace App\Commands;

class LogoutCommand extends AbstractLogCommand
{
    /**
     * Log command name.
     *
     * @var string
     */
    protected static $defaultName = 'logout';

    /**
     * Login exit message.
     *
     * @var string
     */
    protected static $exitMessage = 'Hey! Lazy boy, your LOGOUT mail has been sent. BYE BYE!';

    /**
     * Get log command name.
     *
     * @return string
     */
    public function getSubjectName(): string
    {
        return 'LOGOUT';
    }
}
