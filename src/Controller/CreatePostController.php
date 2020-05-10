<?php

namespace App\Controller;

use App\Entity\Post;
use Core\Controller\AbstractController;
use Core\Util\CSRF;
use Core\Util\FlashBag;

class CreatePostController extends AbstractController
{
    public function __invoke()
    {
        $this->redirectAnonymousUser();
        $postRepository = $this->getRepository(Post::class);
        $formPost = new Post();
        $errors = [];
        $csrfToken = $_POST['csrfToken'] ?? '';
        $formPost->setTitle($_POST['title'] ?? null);
        $formPost->setChapo($_POST['chapo'] ?? null);
        $formPost->setContent($_POST['content'] ?? null);
        $formPost->setAuthor($_POST['author'] ?? null);
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if (empty($formPost->getTitle())) {
                $errors['title'][] = 'Indiquer un titre';
            }
            if (strlen($formPost->getTitle()) < 3) {
                $errors['title'][] = 'Le titre doit faire 3 caractères ou plus';
            }
            if (empty($formPost->getChapo())) {
                $errors['chapo'][] = 'Remplissez le chapô';
            }
            if (strlen($formPost->getChapo()) < 3) {
                $errors['chapo'][] = 'Le chapô doit faire 3 caractères ou plus';
            }
            if (empty($formPost->getContent())) {
                $errors['content'][] = 'Le contenu de l\'article ne peut pas être vide';
            }
            if (strlen($formPost->getContent()) < 3) {
                $errors['content'][] = 'Le contenu doit faire 3 caractères ou plus';
            }
            if (empty($formPost->getAuthor())) {
                $errors['author'][] = 'Le nom de l\'auteur ne peut pas être vide';
            }
            if (strlen($formPost->getAuthor()) < 3) {
                $errors['author'][] = 'Le nom de l\'auteur doit faire 3 caractères ou plus';
            }
            if (!CSRF::checkToken($csrfToken)) {
                $errors['token'][] = 'Token invalide, veuillez renvoyer le formulaire';
            }
            if (empty($errors)) {
                usleep(500000);
                $postRepository->createPost($formPost);
                FlashBag::addFlash('Nouveau post publié sur le blog.', 'success');
                $this->redirect('./blog');
            }
        }
        $this->echoRender('Default/createPost.html.twig', [
            'errors' => $errors,
            'csrfToken' => CSRF::generateToken(),
            'formPost' => $formPost
        ]);
    }
}