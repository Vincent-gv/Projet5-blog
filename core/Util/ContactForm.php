<?php


namespace Core\Util;


use Core\Config\ParameterManager;
use Core\Config\ParametersInterface;

abstract class ContactForm
{
    static public function sendEmail(string $name, string $email, string $subject, string $message): string
    {
        $recipient = ParameterManager::getParameter(ParametersInterface::KEY_EMAIL_CONTACT)->getValue();
        $headers = 'MIME-Version: 1.0' . "\r\n"
            . 'Content-type: text/html; charset=utf-8' . "\r\n"
            . 'From: ' . $email . "\r\n"
            . 'Reply-to:' . $email . '' . "\r\n";
        $content = '<p><strong>Expéditeur : </strong>' . $name . '</p><p><strong>Email : </strong>' . $email . '</p><p><strong>Objet : </strong>' . $subject . '</p><p><strong>Message : </strong>' . $message . '</p>';
        FlashBag::addFlash('Merci ! Votre message a bien été envoyé.', 'success');

        return @mail($recipient, 'Nouveau message Blog : ' . $subject . '', $content, $headers);
    }

}