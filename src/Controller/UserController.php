<?php

namespace App\Controller;

use App\Entity\User;
use Core\Controller\AbstractController;

class UserController extends AbstractController
{
    public function userAction()
    {
        $this->redirectAnonymousUser();
        $userRepository = $this->getRepository(User::class);
        $formUser = new User();
        $formUser->setUsername($_POST['username'] ?? null);
        $formUser->setEmail($_POST['email'] ?? null);
        $formUser->setPassword($_POST['password'] ?? null);
        $errors = [];
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if (empty($formUser->getUsername())) {
                $errors['user'][] = 'Le nom d\'utilisateur ne peut pas être vide';
            }
            if (strlen($formUser->getUsername()) < 3) {
                $errors['user'][] = 'Le nom d\'utilisateur doit faire 3 caractères ou plus';
            }
            if (empty($formUser->getEmail())) {
                $errors['user'][] = 'Le mail ne peut pas être vide';
            }
            if (!filter_var($formUser->getEmail(), FILTER_VALIDATE_EMAIL))  {
                $errors['user'][] = 'Le mail indiqué n\'est pas valide';
            }
            if (strlen($formUser->getPassword()) < 3) {
                $errors['user'][] = 'Le mot de passe doit faire 3 caractères ou plus';
            }
            if (empty($errors)) {
                $userRepository->createUser($formUser);
                $this->redirect('/admin');
            }
        }
        $this->render('Default/user.html.twig', [
            'errors' => $errors,
            'formUser' => $formUser
        ]);
    }
}