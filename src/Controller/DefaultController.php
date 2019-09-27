<?php

namespace App\Controller;


use App\Entity\Post;
use Core\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function homepageAction()
    {
        $postRepository = $this->getRepository(Post::class);
        $posts = $postRepository->findAll();
        var_dump($postRepository->find(1));
        $this->render('Default/homepage.html.twig', [
            'posts' => $posts
        ]);
    }

    public function contactAction()
    {
        $this->render('Default/contact.html.twig');
    }
}