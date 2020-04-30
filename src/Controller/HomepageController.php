<?php

namespace App\Controller;

use Core\Controller\AbstractController;
use Core\Util\CSRF;
use Core\Util\Captcha;

class HomepageController extends AbstractController
{
    public function __invoke()
    {
        $postMessage = null;
        $errors = [];
        $csrfToken = $_POST['csrfToken'] ?? '';
        $reCaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $name = htmlentities($_POST['name']);
            $email = htmlentities($_POST['email']);
            $subject = htmlentities($_POST['subject']);
            $message = htmlentities($_POST['message']);
            $recipient = 'vinzmass@gmail.com';
            $content = '<html><head><title>Nouveau message (vincent-dev.com)</title></head><body>';
            $content .= '<p><strong>Nom</strong>: ' . $name . '</p>';
            $content .= '<p><strong>Email</strong>: ' . $email . '</p>';
            $content .= '<p><strong>Sujet</strong>: ' . $subject . '</p>';
            $content .= '<p><strong>Message</strong>: ' . $message . '</p>';
            $content .= '</body></html>';
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'From: contact@vincent-dev.com' . "\r\n";
            $headers .= 'Reply-to : ' . $email . '' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            if (!CSRF::checkToken($csrfToken)) {
                $errors[] = 'Token invalide, veuillez renvoyer le formulaire';
            }
            if (!Captcha::reCaptcha($reCaptchaResponse)) {
                $errors[] = 'Captcha incorrect, merci de recommencer';
            }
            if (empty($errors)) {
                usleep(500000);
                @mail($recipient, 'Nouveau message (vincent-dev.com)', $content, $headers);
                $postMessage = 'Message envoyé ! Merci :)';
            }
        }
        $this->render('Default/homepage.html.twig', [
            'postMessage' => $postMessage,
            'csrfToken' => CSRF::generateToken(),
            'errors' => $errors
        ]);
    }
}