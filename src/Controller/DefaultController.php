<?php

namespace App\Controller;


use App\Entity\Post;
use App\Entity\Comment;
use Core\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function homepageAction()
    {
        $postRepository = $this->getRepository(Post::class);
        $latestPosts = $postRepository->postLimit();
        $this->render('Default/homepage.html.twig', [
            'latestPosts' => $latestPosts
        ]);
    }

    public function contactAction()
    {
        $postRepository = $this->getRepository(Post::class);
        $latestPosts = $postRepository->postLimit();
        $this->render('Default/contact.html.twig', [
            'latestPosts' => $latestPosts
        ]);
    }

    public function blogAction()
    {
        $postRepository = $this->getRepository(Post::class);
        $latestPosts = $postRepository->postLimit();
        $pageIndex = intval($_GET['page'] ?? 0);
        $pagination = $postRepository->pagination(1);
        $this->render('Default/blog.html.twig', [
            'posts' => $postRepository,
            'latestPosts' => $latestPosts,
            'pagination' => $pagination
        ]);
        var_dump($pagination);
    }

    public function postAction()
    {
        $postId = $_GET['id'] ?? null;
        $postRepository = $this->getRepository(Post::class);
        $posts = $postRepository->postLimit();
        $post = $postRepository ->find($postId);
        var_dump($post);
        $this->render('Default/blog-post.html.twig', [
            'posts' => $posts,
            'post' => $post,
        ]);
    }

    public function enregistrementAction()
    {
        $postRepository = $this->getRepository(Post::class);
        $posts = $postRepository->postLimit();
        $this->render('Default/enregistrement.html.twig', [
            'posts' => $posts
        ]);
    }
}