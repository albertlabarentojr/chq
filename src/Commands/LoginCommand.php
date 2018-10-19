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
     * Get log command name.
     *
     * @return string
     */
    public function getSubjectName(): string
    {
        return 'LOGIN';
    }
}
