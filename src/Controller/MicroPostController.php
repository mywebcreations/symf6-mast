<?php

namespace App\Controller;

use App\Repository\MicroPostRepository;
use App\Entity\MicroPost;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post/create', name: 'app_micro_post_create')]
    public function createPost(): Response
    {
        $microPost = new MicroPost();
        $form = $this->createFormBuilder($microPost)
            ->add('title')
            ->add('text')
            ->getForm();
        
        return $this->render('micro_post/post.html.twig', [
            'form' => $microPost,
        ]);
    }

}
