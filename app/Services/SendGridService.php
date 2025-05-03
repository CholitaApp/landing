<?php declare(strict_types=1);

namespace App\Services;

use Exception;
use SendGrid;
use SendGrid\Mail\Mail;

class SendGridService
{
    protected SendGrid $client;

    public function __construct()
    {
        $this->client = new SendGrid(config('app.SENDGRID_API_KEY'));
    }
    public function send(string $to, string $subject, string $plainContent, string $htmlContent): bool
    {
        $email = new Mail();
        $email->setFrom(config('mail.from.address'), config('mail.from.name'));
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent('text/plain', $plainContent);
        $email->addContent('text/html', $htmlContent);


        try {
            $response = $this->client->send($email);
            return $response->statusCode() < 300;
        } catch (Exception $e) {
            logger()->error('SendGrid Error: '.$e->getMessage());
            return false;
        }
    }
}
