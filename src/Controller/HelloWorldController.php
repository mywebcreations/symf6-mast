<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldController extends AbstractController
{
    public function helloWord(): Response {
        return new Response("Hello World!");
    }
}