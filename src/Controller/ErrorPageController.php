<?php

namespace App\Controller;

use Core\Controller\AbstractController;
use Core\Exception\NotFoundException;
use Exception;

class ErrorPageController extends AbstractController
{
    public function __invoke(Exception $exception)
    {
        $isError404 = $exception instanceof NotFoundException;
        if ($isError404) {
            http_response_code(404);
        } else {
            http_response_code(500);
        }
        $this->echoRender(
            'Default/errorPage.html.twig',
            [
                'isError404' => $isError404
            ]
        );
    }
}
