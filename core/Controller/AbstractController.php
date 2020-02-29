<?php


namespace Core\Controller;

use App\Entity\Post;
use Core\Database\Repository\AbstractRepository;
use Core\Database\Repository\RepositoryFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

abstract class AbstractController
{
    public function getRepository(string $entity): AbstractRepository
    {
        return RepositoryFactory::createRepository($entity);
    }

    public function render(string $name, array $context = [])
    {
        $loader = new FilesystemLoader('../templates');
        $twig = new Environment($loader, [
            'strict_variables' => true
        ]);
        $this->extendTwig($twig);

        echo $twig->render($name, $context);

    }

    public function redirect (string $url) {
        header('Location: '.$url);
        die();
    }

    public function extendTwig (Environment $twig) {
        $function = new TwigFunction('latestPosts', function () {
            $postRepository = $this->getRepository(Post::class);
            return $postRepository->latestPosts();
        });
        $twig->addFunction($function);
    }

}