<?php

namespace App\Controller;

use Core\Controller\AbstractController;
use Core\Util\ContactForm;
use Core\Util\CSRF;
use Core\Util\Captcha;

class ContactController extends AbstractController
{
    public function __invoke()
    {
        $errors = [];
        $displayForm = true;
        $csrfToken = $_POST['csrfToken'] ?? '';
        $reCaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
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
                $errors['email'][] = 'Le mail ne peut pas être vide';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'][] = 'Le mail est invalide';
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
                usleep(500000);
                $displayForm = false;
                ContactForm::getContactForm($name, $email, $subject, $message);
            }
        }
        $this->echoRender('Default/contact.html.twig', [
            'csrfToken' => CSRF::generateToken(),
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'displayForm' => $displayForm,
            'errors' => $errors
        ]);
    }
}