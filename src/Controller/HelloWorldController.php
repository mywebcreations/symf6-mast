<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    // private array $messages = ["Christy", "Quincy", "Pascal"];

    private array $messages = [
        ['subject' => 'Christy', 'created' => '2023/08/31'],
        ['subject' => 'Quincy', 'created' => '2023/08/29'],
        ['subject' => 'Pascal', 'created' => '2022/09/29']
    ];

    #[Route('/', name: 'app_hello_world')]
    public function helloWorld(): Response {
        return $this->render(
            'hello-world/hello-world.html.twig',
            [
                'message' => 'Hello World!'
            ]
        );
        
        // return new Response("Hello World!");
    }
    
    #[Route('/messages-to-string', name: 'app_messages_to_string')]
    public function messagesToString(): Response {
        return $this->render(
            'hello-world/messages-to-string.html.twig',
            [
                // 'message' => implode(',', $this->messages)
                'message' => $this->messages
            ]
        );
             
        // return new Response(implode(',', $this->messages));
    }

    #[Route('/show-one/{id<\d+>}', name: 'app_show_one')]
    public function showOne(int $id): Response {
        return $this->render(
            'hello-world/show-one.html.twig',
            array(
                'message' => $this->messages[$id]
            )
        );
        
        // return new Response($this->messages[$id]);
    }

    #[Route('/messages-as-is/{index}', name: 'app_messages_as_is')]
    public function messagesAsIs($index): Response {
        return $this->render(
            'hello-world/messages-as-is.html.twig',
            [
                'message' => $this->messages,
                'limit'   => $index
            ]
        );
             
        // return new Response(implode(',', $this->messages));
    }
}