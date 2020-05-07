<?php

namespace App\Controller;

use Core\Config\ParameterManager;
use Core\Config\ParametersInterface;
use Core\Controller\AbstractController;
use Core\Util\CSRF;
use Core\Util\Captcha;
use Core\Util\FlashBag;

class HomepageController extends AbstractController
{
    public function __invoke()
    {
        $postMessage = null;
        $errors = [];
        $csrfToken = $_POST['csrfToken'] ?? '';
        $recipient = ParameterManager::getParameter(ParametersInterface::KEY_EMAIL_CONTACT);
        $captchaPublicKey = ParameterManager::getParameter(ParametersInterface::KEY_CAPTCHA_PUBLIC_KEY);
        $reCaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $name = htmlentities($_POST['name']);
            $email = htmlentities($_POST['email']);
            $subject = htmlentities($_POST['subject']);
            $message = htmlentities($_POST['message']);
            if (empty($name)) {
                $errors['name'][] = 'Le nom ne peut pas être vide';
            }
            if (strlen($name) < 3) {
                $errors['name'][] = 'Le nom doit faire 3 caractères ou plus';
            }
            if (empty($email)) {
                $errors['mail'][] = 'Le mail ne peut pas être vide';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['mail'][] = 'Le mail est invalide';
            }
            if (empty($message)) {
                $errors['message'][] = 'Le message ne peut pas être vide';
            }
            if (strlen($message) < 3) {
                $errors['message'][] = 'Le message doit faire 3 caractères ou plus';
            }
            if (!CSRF::checkToken($csrfToken)) {
                $errors['token'][] = 'Token invalide, veuillez renvoyer le formulaire';
            }
            if (!Captcha::reCaptcha($reCaptchaResponse)) {
                $errors['captcha'][] = 'Captcha incorrect, merci de recommencer';
            }
            if (empty($errors)) {
                $recipient = ParameterManager::getParameter(ParametersInterface::KEY_EMAIL_CONTACT);
                $content = '<html><head><title>Nouveau message (Blog)</title></head><body>';
                $content .= '<p><strong>Nom</strong>: ' . $name . '</p>';
                $content .= '<p><strong>Email</strong>: ' . $email . '</p>';
                $content .= '<p><strong>Sujet</strong>: ' . $subject . '</p>';
                $content .= '<p><strong>Message</strong>: ' . $message . '</p>';
                $content .= '</body></html>';
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'From:' . $recipient[1] .'' . "\r\n";
                $headers .= 'Reply-to:' . $email . '' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                usleep(500000);
                @mail($recipient[1], 'Nouveau message (Blog)', $content, $headers);
                FlashBag::addFlash('Votre message a bien été envoyé !', 'success');
                $this->redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $this->echoRender('Default/homepage.html.twig', [
            'captchaPublicKey' => $captchaPublicKey,
            'csrfToken' => CSRF::generateToken(),
            'errors' => $errors
        ]);
    }
}