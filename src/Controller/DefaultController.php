<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use Core\Controller\AbstractController;

class DefaultController extends AbstractController
{

    public function homepageAction()
    {
        $articleRepository = $this->getRepository(Article::class);
        $latestPosts = $articleRepository->latestPosts();
        $this->render('Default/homepage.html.twig', [
            'latestPosts' => $latestPosts
        ]);
    }

    public function contactAction()
    {
        $articleRepository = $this->getRepository(Article::class);
        $latestPosts = $articleRepository->latestPosts();
        $this->render('Default/contact.html.twig', [
            'latestPosts' => $latestPosts
        ]);
    }

    public function blogAction()
    {
        $articleRepository = $this->getRepository(Article::class);
        $latestPosts = $articleRepository->latestPosts();
        $pageIndex = intval($_GET['page'] ?? 1);
        $pagination = $articleRepository->pagination($pageIndex);
        $this->render('Default/blog.html.twig', [
            'posts' => $articleRepository,
            'latestPosts' => $latestPosts,
            'pagination' => $pagination
        ]);
    }

    public function articleAction()
        {
            $postId = $_GET['id'];
            $articleRepository = $this->getRepository(Article::class);
            $commentRepository = $this->getRepository(Comment::class);
            $comments = $commentRepository->findBy(['post_id' => $postId]);
            $latestPosts = $articleRepository->latestPosts();
            $countComments = $articleRepository->countPostComments($postId);
            $article = $articleRepository->find($postId);
            $formComment = new Comment();
            $errors = [];
            $formComment->setUsername($_POST['username'] ?? null);
            $formComment->setComment($_POST['comment'] ?? null);
            $formComment->setPostId($postId);
            // Post Comment
            if ('POST' === $_SERVER['REQUEST_METHOD'])  {
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
                if (empty($errors)) {
                    $commentRepository->create($formComment);
                    $this->redirect($_SERVER['HTTP_REFERER']);
                }
            }

            $this->render('Default/article.html.twig', [
                'latestPosts' => $latestPosts,
                'post' => $article,
                'comments' => $comments,
                'countComments' => $countComments,
                'errors' => $errors,
                'formComment' => $formComment
            ]);
        }

    public function registerAction()
    {
        $articleRepository = $this->getRepository(Article::class);
        $latestPosts = $articleRepository->latestPosts();
        $this->render('Default/enregistrement.html.twig', [
            'latestPosts' => $latestPosts
        ]);
    }

    public function postAction()
    {
        $articleRepository = $this->getRepository(Article::class);
        $latestPosts = $articleRepository->latestPosts();
        $formArticle = new Article();
        $errors = [];
        $formArticle->setTitle($_POST['title'] ?? null);
        $formArticle->setChapo($_POST['chapo'] ?? null);
        $formArticle->setContent($_POST['content'] ?? null);
        $formArticle->setAuthor($_POST['author'] ?? null);
        // Post Article
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if (empty($formArticle->getTitle())) {
                $errors['title'][] = 'Indiquer un titre';
            }
            if (strlen($formArticle->getTitle()) < 3) {
                $errors['title'][] = 'Le titre doit faire 3 caractères ou plus';
            }
            if (empty($formArticle->getChapo())) {
                $errors['chapo'][] = 'Remplissez le chapô';
            }
            if (strlen($formArticle->getChapo()) < 3) {
                $errors['chapo'][] = 'Le chapô doit faire 3 caractères ou plus';
            }
            if (empty($formArticle->getContent())) {
                $errors['content'][] = 'Le contenu de l\'article ne peut pas être vide';
            }
            if (strlen($formArticle->getContent()) < 3) {
                $errors['content'][] = 'Le contenu doit faire 3 caractères ou plus';
            }
            if (empty($formArticle->getAuthor())) {
                $errors['author'][] = 'Le nom de l\'auteur ne peut pas être vide';
            }
            if (strlen($formArticle->getAuthor()) < 3) {
                $errors['author'][] = 'Le nom de l\'auteur doit faire 3 caractères ou plus';
            }
            if (empty($errors)) {
                $articleRepository->create($formArticle);
                $id = $articleRepository->getLastInsertId();
                $this->redirect('/post?id=' . $id);
            }
        }

        $this->render('Default/newArticle.html.twig', [
            'latestPosts' => $latestPosts,
            'errors' => $errors,
            'formArticle' => $formArticle
        ]);
    }
}