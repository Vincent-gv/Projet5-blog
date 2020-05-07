<?php

namespace App\Controller;

use Core\Config\ParameterManager;
use Core\Config\ParametersInterface;
use Core\Controller\AbstractController;
use Core\Util\CSRF;

class ContactController extends AbstractController
{
    public function __invoke()
    {
        $errors = [];
        $postMessage = null;
        $captchaPublicKey = ParameterManager::getParameter(ParametersInterface::KEY_CAPTCHA_PUBLIC_KEY);
        $googleMapKey = ParameterManager::getParameter(ParametersInterface::KEY_GOOGLE_MAP);
        $csrfToken = $_POST['csrfToken'] ?? '';
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $name = htmlentities($_POST['name']);
            $email = htmlentities($_POST['email']);
            $subject = htmlentities($_POST['subject']);
            $message = htmlentities($_POST['message']);
            $recipient = ParameterManager::getParameter(ParametersInterface::KEY_EMAIL_CONTACT);
            $content = '<html><head><title>Nouveau message (vincent-dev.com)</title></head><body>';
            $content .= '<p><strong>Nom</strong>: ' . $name . '</p>';
            $content .= '<p><strong>Email</strong>: ' . $email . '</p>';
            $content .= '<p><strong>Sujet</strong>: ' . $subject . '</p>';
            $content .= '<p><strong>Message</strong>: ' . $message . '</p>';
            $content .= '</body></html>';
            $content = $this->render('Default/mailBody.html.twig', [
                'csrfToken' => CSRF::generateToken(),
                'errors' => $errors,
                'postMessage' => $postMessage
            ]);
            // todo check values
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'From: contact@vincent-dev.com' . "\r\n";
            $headers .= 'Reply-to : ' . $email . '' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            if (!CSRF::checkToken($csrfToken)) {
                $errors[] = 'Token invalide, veuillez renvoyer le formulaire';
            }
            if (empty($errors)) {
                usleep(500000);
                @mail($recipient[1], 'Nouveau message (vincent-dev.com)', $content, $headers);
                $postMessage = 'Message envoyé ! Merci :)';
            }
        }
        $this->echoRender('Default/contact.html.twig', [
            'csrfToken' => CSRF::generateToken(),
            'captchaPublicKey' => $captchaPublicKey,
            'googleMapKey' => $googleMapKey,
            'errors' => $errors,
            'postMessage' => $postMessage
        ]);
    }
}