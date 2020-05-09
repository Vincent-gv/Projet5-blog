<?php

namespace App\Controller;

use App\Entity\User;
use Core\Controller\AbstractController;
use Core\Util\CSRF;
use Core\Util\FlashBag;

class ConnectController extends AbstractController
{
    public function __invoke()
    {
        $userRepository = $this->getRepository(User::class);
        $formUser = new User();
        $formUser->setEmail($_POST['login'] ?? null);
        $formUser->setPassword($_POST['password'] ?? null);
        $email = $formUser->getEmail();
        $password = $formUser->getPassword();
        $user = $userRepository->findByEmail($email);
        $errors = [];
        $csrfToken = $_POST['csrfToken'] ?? '';
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if (empty($email)) {
                $errors['user'][] = 'L\'identifiant ne peut pas être vide';
            }
            if (empty($password)) {
                $errors['user'][] = 'Le mot de passe ne peut pas être vide';
            } else if (!$user instanceof User) {
                $errors['user'][] = 'Identifiants incorrects';
            } else if (!password_verify($password, $user->getPassword())) {
                $errors['user'][] = 'Identifiants incorrects';
            }
            if (!CSRF::checkToken($csrfToken)) {
                $errors['token'][] = 'Token invalide, veuillez renvoyer le formulaire';
            }
            if (empty($errors)) {
                usleep(500000);
                $_SESSION['userConnected'] = $user;
                $this->redirect('/admin');
            }
            if (isset($_POST['disconnect'])) {
                unset($_SESSION['userConnected']);
                FlashBag::addFlash('Déconnexion réussie.', 'success');
                $this->redirect('/admin');
            }
        }
        $this->echoRender('Default/admin.html.twig', [
            'errors' => $errors,
            'csrfToken' => CSRF::generateToken(),
            'formUser' => $formUser
        ]);
    }
}