<?php

namespace App\Controller;

use App\Entity\Post;
use Core\Controller\AbstractController;

class BlogController extends AbstractController
{
    public function blogAction()
    {
        $postRepository = $this->getRepository(Post::class);
        $pageIndex = intval($_GET['page'] ?? 1);
        $pagination = $postRepository->pagination($pageIndex, 3);
        $this->render('Default/blog.html.twig', [
            'posts' => $postRepository,
            'pagination' => $pagination
        ]);
    }
}