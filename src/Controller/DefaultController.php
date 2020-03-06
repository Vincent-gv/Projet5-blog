<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use Core\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function homepageAction()
    {
        $email = $_POST['mail'] ?? null;
        $name = $_POST['name'] ?? null;
        $subject = $_POST['subject'] ?? null;
        $message = $_POST['message'] ?? null;
        $sendTo = 'vincent.gauchevertu@hotmail.fr';
        $headers = 'From : ' . $email;
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
//            mail($sendTo,$subject,$message,$headers);
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
        $this->render('Default/homepage.html.twig', [
        ]);
    }

    public function contactAction()
    {
        $this->render('Default/contact.html.twig', [
        ]);
    }

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

    public function articleAction()
    {
        $postId = $_GET['id'];
        $postRepository = $this->getRepository(Post::class);
        $commentRepository = $this->getRepository(Comment::class);
        $comments = $commentRepository->findBy(['post_id' => $postId]);
        $countComments = $commentRepository->countPostComments($postId);
        $successMessage = null;
        $article = $postRepository->find($postId);
        $formComment = new Comment();
        $errors = [];
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
            if (empty($errors)) {
                $commentRepository->createComment($formComment);
                $this->redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $this->render('Default/post.html.twig', [
            'post' => $article,
            'comments' => $comments,
            'countComments' => $countComments,
            'errors' => $errors,
            'formComment' => $formComment
        ]);
    }

    public function postAction()
    {
        $this->redirectAnonymousUser();
        $postRepository = $this->getRepository(Post::class);
        $formPost = new Post();
        $errors = [];
        $formPost->setTitle($_POST['title'] ?? null);
        $formPost->setChapo($_POST['chapo'] ?? null);
        $formPost->setContent($_POST['content'] ?? null);
        $formPost->setAuthor($_POST['author'] ?? null);
        // Post Post
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
            if (empty($errors)) {
                $postRepository->createPost($formPost);
                $id = $postRepository->getLastInsertId();
                $this->redirect('/post?id=' . $id);
            }
        }
        $this->render('Default/newPost.html.twig', [
            'errors' => $errors,
            'formPost' => $formPost
        ]);
    }

    public function updateAction()
    {
        $this->redirectAnonymousUser();
        $id = $_GET['id'];
        $postRepository = $this->getRepository(Post::class);
        $postId = $postRepository->find($id);
        $errors = [];
        $formPost = new Post();
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
            if (empty($errors)) {
                $postRepository->updatePost($formPost);
                $this->redirect('/post?id=' . $id);
            }
        }
        if ($_POST['delete-post'] ?? false) {
            $postRepository->deletePost($id);
            $this->redirect('./blog');
        }
        $this->render('Default/updatePost.html.twig', [
            'getPost' => $postId,
            'errors' => $errors,
            'formPost' => $formPost
        ]);
    }

    public function moderateAction()
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
        $this->render('Default/moderate.html.twig', [
            'comment' => $commentRepository,
            'comments' => $comments,
            'posts' => $posts,
            'pagination' => $pagination
        ]);
    }
}