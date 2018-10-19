<?php
declare(strict_types=1);

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    /**
     * Mail Subject.
     *
     * @var PHPMailer
     */
    private $mail;

    /**
     * Mail constructor.
     *
     * @param null|string $body
     * @param null|string $subject
     *
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function __construct(string $body = null, string $subject = null)
    {
        $this->boot();

        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
    }

    /**
     * Send mail.
     *
     * @return void
     *
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function send(): void
    {
        $this->mail->send();
    }

    /**
     * Boot mail setup.
     *
     * @return void
     *
     * @throws \PHPMailer\PHPMailer\Exception
     */
    private function boot(): void
    {
        $this->mail = new PHPMailer(true);

        $this->mail->SMTPDebug = 2;
        $this->mail->isSMTP();
        $this->mail->Host = \getenv('MAIL_HOST');
        $this->mail->SMTPAuth = true;
        $this->mail->Username = \getenv('MAIL_USERNAME');
        $this->mail->Password = \getenv('MAIL_PASSWORD');
        $this->mail->SMTPSecure = \getenv('MAIL_ENCRYPTION');
        $this->mail->Port = \getenv('MAIL_PORT');

        $this->mail->setFrom(\getenv('MAIL_FROM_NAME'), \getenv('MAIL_NAME'));
        $this->mail->addAddress('albert.labarentojr@flexisourceit.com.au');
        $this->mail->addCC('albertlabarento@yopmail.com');
    }
}
