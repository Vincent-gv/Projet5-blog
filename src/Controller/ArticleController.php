<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use Core\Controller\AbstractController;
use Core\Util\CSRF;

class ArticleController extends AbstractController
{
    public function __invoke()
    {
        $postId = $_GET['id'];
        $postRepository = $this->getRepository(Post::class);
        $commentRepository = $this->getRepository(Comment::class);
        $comments = $commentRepository->findBy(['post_id' => $postId]);
        $countComments = $commentRepository->countPostComments($postId);
        $article = $postRepository->find($postId);
        $errors = [];
        $csrfToken = $_POST['csrfToken'] ?? '';
        $postMessage = null;
        $formComment = new Comment();
        $formComment->setUsername($_POST['username'] ?? null);
        $formComment->setComment($_POST['comment'] ?? null);
        $formComment->setPostId($postId);
        // Post Comment
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if (empty($formComment->getUsername())) {
                $errors['username'][] = 'Indiquer un nom d\'utilisateur';
            }
            if (strlen($formComment->getUsername()) < 3) {
                $errors['username'][] = 'Le nom doit faire 3 caractères ou plus';
            }
            if (empty($formComment->getComment())) {
                $errors['comment'][] = 'Le commentaire ne peut pas être vide';
            }
            if (strlen($formComment->getComment()) < 3) {
                $errors['comment'][] = 'Le commentaire doit faire 3 caractères ou plus';
            }
            if (!CSRF::checkToken($csrfToken)) {
                $errors['token'][] = 'Token invalide, veuillez renvoyer le formulaire';
            }
            if (empty($errors)) {
                sleep(1);
                $postMessage = 'Commentaire envoyé en attente de modération.';
                $commentRepository->createComment($formComment);
                //$this->redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $this->render('Default/post.html.twig', [
            'postMessage' => $postMessage,
            'post' => $article,
            'comments' => $comments,
            'countComments' => $countComments,
            'errors' => $errors,
            'csrfToken' => CSRF::generateToken(),
            'formComment' => $formComment
        ]);
    }
}