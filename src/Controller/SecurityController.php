<?php

namespace App\Controller;

use App\Entity\User;
use Core\Controller\AbstractController;

class SecurityController extends AbstractController
{
    public function connectAction()
    {
        $formUser = new User();
        $formUser->setEmail($_POST['login'] ?? null);
        $formUser->setPassword($_POST['password'] ?? null);
        $email = $formUser->getEmail();
        $password = $formUser->getPassword();
        $userRepository = $this->getRepository(User::class);
        $user = $userRepository->findByEmail($email);
        $errors = [];
        if (empty($email)) {
            $errors['user'][] = 'L\'identifiant ne peut pas être vide';
        }
        if (empty($password)) {
            $errors['user'][] = 'Le mot de passe ne peut pas être vide';
        }
        else if (!$user instanceof User) {
            $errors['user'][] = 'Identifiants incorrects';
        }
        else if (!password_verify($password, $user->getPassword())) {
            $errors['user'][] = 'Identifiants incorrects';
        }
        if (empty($errors)) {
            $_SESSION['userConnected'] = $user;
            $this->redirect('/');
        }
        $this->render('Default/connect.html.twig', [
        'errors' => $errors,
        'formUser' => $formUser
    ]);

    }
}