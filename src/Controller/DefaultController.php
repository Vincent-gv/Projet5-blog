<?php

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\FormException;
use Core\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function homepageAction()
    {
        $postRepository = $this->getRepository(Article::class);
        $latestPosts = $postRepository->latestPosts();
        $this->render('Default/homepage.html.twig', [
            'latestPosts' => $latestPosts
        ]);
    }

    public function contactAction()
    {
        $postRepository = $this->getRepository(Article::class);
        $latestPosts = $postRepository->latestPosts();
        $this->render('Default/contact.html.twig', [
            'latestPosts' => $latestPosts
        ]);
    }

    public function blogAction()
    {
        $postRepository = $this->getRepository(Article::class);
        $latestPosts = $postRepository->latestPosts();
        $pageIndex = intval($_GET['page'] ?? 1);
        $pagination = $postRepository->pagination($pageIndex);
        $this->render('Default/blog.html.twig', [
            'posts' => $postRepository,
            'latestPosts' => $latestPosts,
            'pagination' => $pagination
        ]);
    }

    public function postAction()
    {
        $postId = $_GET['id'];
        $postRepository = $this->getRepository(Article::class);
        $commentRepository = $this->getRepository(Comment::class);
        $comments = $commentRepository->findBy(['post_id' => $postId]);
        $latestPosts = $postRepository->latestPosts();
        $article = $postRepository->find($postId);
        $formComment = new Comment();
        $errorsComment = [];
        $formComment->setUsername($_POST['username'] ?? null);
        $formComment->setComment($_POST['comment'] ?? null);
        $formComment->setPostId($postId);
        // Post Comment
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if (empty($formComment->getUsername())) {
                $errorsComment['error'][] = 'Merci d\'indiquer un nom d\'utilisateur';
            }
            if (strlen($formComment->getUsername()) < 3) {
                $errorsComment['error'][] = 'Le nom doit faire 3 caractères ou plus';
            }
            if (empty($formComment->getComment())) {
                $errorsComment['error'][] = 'Le commentaire ne peut pas être vide';
            }
            if (strlen($formComment->getComment()) < 3) {
                $errorsComment['error'][] = 'Le commentaire doit faire 3 caractères ou plus';
            }
            if (empty($errorsComment)) {
                $commentRepository->create($formComment);
                $this->redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $this->render('Default/article.html.twig', [
            'latestPosts' => $latestPosts,
            'post' => $article,
            'comments' => $comments,
            'errorsComment' => $errorsComment,
            'formComment' => $formComment
        ]);
    }

    public function enregistrementAction()
    {
        $postRepository = $this->getRepository(Article::class);
        $latestPosts = $postRepository->latestPosts();
        $this->render('Default/enregistrement.html.twig', [
            'latestPosts' => $latestPosts
        ]);
    }

    public function ajouterArticleAction()
    {
        $postRepository = $this->getRepository(Article::class);
        $latestPosts = $postRepository->latestPosts();
        $formArticle = new Article();
        $errorsArticle = [];
        $formArticle->setTitle($_POST['title'] ?? null);
        $formArticle->setContent($_POST['content'] ?? null);
        // Post Article
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if (empty($formArticle->getTitle())) {
                $errorsArticle['error'][] = 'Merci d\'indiquer un titre';
            }
            if (strlen($formArticle->getTitle()) < 3) {
                $errorsArticle['error'][] = 'Le titre doit faire 3 caractères ou plus';
            }
            if (empty($formArticle->getContent())) {
                $errorsArticle['error'][] = 'Le texte ne peut pas être vide';
            }
            if (strlen($formArticle->getContent()) < 3) {
                $errorsArticle['error'][] = 'Le texte doit faire 3 caractères ou plus';
            }
            if (empty($errorsArticle)) {
                $postRepository->create($formArticle);
                $this->redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $this->render('Default/newArticle.html.twig', [
            'latestPosts' => $latestPosts,
            'errorsArticle' => $errorsArticle,
            'formArticle' => $formArticle
        ]);
    }
}