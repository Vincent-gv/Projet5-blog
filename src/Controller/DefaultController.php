<?php

namespace App\Controller;


use App\Entity\Post;
use Core\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function homepageAction()
    {
        $postRepository = $this->getRepository(Post::class);
        $page = intval($_GET['p'] ?? 0);
        $limit = 3;
        $offset = $page * $limit;
        $posts = $postRepository->findBy([], [], $limit, $offset);
        $nbPosts = $postRepository->countAll();
        $this->render('Default/homepage.html.twig', [
            'posts' => $posts,
            'nbPosts' => $nbPosts
        ]);
        var_dump($page);
    }

    public function contactAction()
    {
        $postRepository = $this->getRepository(Post::class);
        $posts = $postRepository->postLimit();
        $this->render('Default/contact.html.twig', [
            'posts' => $posts
        ]);
    }

    public function blogAction()
    {
        $postRepository = $this->getRepository(Post::class);
        $posts = $postRepository->postLimit();
        $page = intval($_GET['p'] ?? 0);
        $pageIndex = intval($_GET['page'] ?? 0);
        $pagination = $postRepository->pagination(1);
        $this->render('Default/blog.html.twig', [
            'page' => $page,
            'posts' => $posts,
            'pagination' => $pagination
        ]);
        echo $pageIndex;
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