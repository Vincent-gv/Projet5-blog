<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use Core\Controller\AbstractController;

class ModerateController extends AbstractController
{
    public function __invoke()
    {
        $this->redirectAnonymousUser();
        $postRepository = $this->getRepository(Post::class);
        $commentRepository = $this->getRepository(Comment::class);
        $formComment = new Comment();
        $formComment->setStatus($_POST['status'] ?? null);
        $comments = $commentRepository->comments();
        $deleteId = $_POST['delete_id'] ?? null;
        $commentRepository->deleteComment($deleteId);
        $publishId = $_POST['publish_id'] ?? null;
        $commentRepository->publishComment($publishId);
        $pageIndex = intval($_GET['page'] ?? 1);
        $pagination = $commentRepository->pagination($pageIndex, 10);
        $postIds = array_unique(array_map(function (Comment $comment) {
            return $comment->getPostId();
        }, $pagination['data']));
        $postsRaw = $postRepository->findBy(['id' => $postIds]);
        $posts = [];
        foreach ($postsRaw as $post) {
            $posts [$post->getId()] = $post;
        }
        $this->echoRender('Default/moderate.html.twig', [
            'comment' => $commentRepository,
            'comments' => $comments,
            'posts' => $posts,
            'pagination' => $pagination
        ]);
    }
}
