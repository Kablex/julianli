<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\Api\Resources\Contact;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ContactHandler implements MessageHandlerInterface
{
    private $adminEmail;
    private $hostEmail;
    private $mailer;

    public function __construct(string $adminEmail, string $hostEmail, Swift_Mailer $mailer)
    {
        $this->adminEmail = $adminEmail;
        $this->hostEmail = $hostEmail;
        $this->mailer = $mailer;
    }

    public function __invoke(Contact $contact)
    {
        $content = \sprintf("Email from %s \r\nMessage: \r\n%s", $contact->email, $contact->message);

        $message = (new Swift_Message($contact->subject))
            ->setFrom($this->hostEmail)
            ->setTo($this->adminEmail)
            ->setBody($content, 'text/plain');

        $this->mailer->send($message);
    }
}
