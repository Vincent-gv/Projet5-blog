<?php

namespace App\Controller;


use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\User;
use Core\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function homepageAction()
    {
        $postRepository = $this->getRepository(Post::class);
        $latestPosts = $postRepository->latestPosts();
        $this->render('Default/homepage.html.twig', [
            'latestPosts' => $latestPosts
        ]);
    }

    public function contactAction()
    {
        $postRepository = $this->getRepository(Post::class);
        $latestPosts = $postRepository->latestPosts();
        $this->render('Default/contact.html.twig', [
            'latestPosts' => $latestPosts
        ]);
    }

    public function blogAction()
    {
        $postRepository = $this->getRepository(Post::class);
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
        $postId = $_GET['id'] ?? 1;
        $postRepository = $this->getRepository(Post::class);
        $commentRepository = $this->getRepository(Comment::class);
        $comments = $commentRepository ->findBy(['id_post'=>$postId]);
        /*   $idUser =   $commentRepository ->find('id');
             $userRepository = $this->getRepository(User::class);
                $user = $userRepository ->findBy(['id'=>$postId]);*/
        $latestPosts = $postRepository->latestPosts();
        $article = $postRepository->find($postId);
        $form = [
            'errors' => null,
        ];

        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $commentBody = $_POST['comment'] ?? null;
            $commentUser = $_POST['user'] ?? null;

            if (empty($commentUser)) {
                $form['errors'][] = 'Le nom ne peut pas être vide';
            }
            if (strlen($commentUser) < 3) {
                $form['errors'][] = 'Le nom doit faire 3 caractères ou plus';
            }
            if (empty($commentBody)) {
                $form['errors'][] = 'Le commentaire ne peut pas être vide';
            }
            if (strlen($commentBody) < 3) {
                $form['errors'][] = 'Le commentaire doit faire 3 caractères ou plus';
            }
            if (empty($errors)) {
                $this->getRepository(Comment::class)->insertComment([
                    'body' => $commentBody,
                    'user' => $commentUser,
                ]);
            }

            $form['comment_body'] = $commentBody;
            $form['comment_user'] = $commentUser;
        };

        $this->render('Default/article.html.twig', [
            'latestPosts' => $latestPosts,
            'post' => $article,
            'comments' => $comments,
            'form' => $form
        ]);
    }

    public function enregistrementAction()
    {
        $postRepository = $this->getRepository(Post::class);
        $latestPosts = $postRepository->latestPosts();
        $this->render('Default/enregistrement.html.twig', [
            'latestPosts' => $latestPosts
        ]);
    }
}