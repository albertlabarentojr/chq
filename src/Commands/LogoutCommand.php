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
     * Get log command name.
     *
     * @return string
     */
    public function getSubjectName(): string
    {
        return 'LOGOUT';
    }
}