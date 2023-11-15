<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    private array $messages = ["Hello", "Hi", "Bye"];

    #[Route('/', name: 'app_hello_world')]
    public function helloWorld(): Response {
        return new Response("Hello World!");
    }

    #[Route('/messages-to-string', name: 'app_messages_to_string')]
    public function messagesToString(): Response {
        return new Response(implode(',', $this->messages));
    }

    #[Route('/show-one/{id<\d+>}', name: 'app_show_one')]
    public function showOne(int $id): Response {
        return new Response($this->messages[$id]);
    }
}