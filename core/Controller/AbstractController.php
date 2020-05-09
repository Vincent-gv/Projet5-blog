<?php

namespace Core\Controller;

use App\Config\Parameters;
use App\Entity\Post;
use Core\Config\ParameterManager;
use Core\Database\Repository\AbstractRepository;
use Core\Database\Repository\RepositoryFactory;
use Core\Util\FlashBag;
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

        return $twig->render($name, $context);
    }

    public function echoRender(string $name, array $context = [])
    {
        echo $this->render($name, $context);
    }

    public function redirect(string $url)
    {
        header('Location: ' . $url);
        die();
    }

    public function isConnected(): bool
    {
        return isset($_SESSION['userConnected']);
    }

    public function redirectAnonymousUser(): void
    {
        if (!$this->isConnected()) {
            $this->redirect('./admin');
        }
    }

    public function extendTwig(Environment $twig)
    {
        // show latest posts
        $latest = new TwigFunction('latestPosts', function () {
            $postRepository = $this->getRepository(Post::class);
            return $postRepository->latestPosts();
        });
        $twig->addFunction($latest);

        // verify if user is connected
        $user = new TwigFunction('user', function () {
            if ($this->isConnected()) {
                return $_SESSION['userConnected'];
            };
        });
        $twig->addFunction($user);

        // Flashbag
        $flashbag = new TwigFunction('flashbag', function () {
            return FlashBag::getFlashs();
        });
        $twig->addFunction($flashbag);

        // Get Captcha Public Key
        $captchaPublicKey = new TwigFunction('captchaPublicKey', function () {
            return ParameterManager::getParameter(Parameters::KEY_CAPTCHA_PUBLIC_KEY)->getValue();
        });
        $twig->addFunction($captchaPublicKey);

        // Get Google Map Public Key
        $googleMapKey = new TwigFunction('googleMapKey', function () {
            return ParameterManager::getParameter(Parameters::KEY_GOOGLE_MAP)->getValue();
        });
        $twig->addFunction($googleMapKey);
    }
}