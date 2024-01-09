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
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(
        EntityManagerInterface $em, 
        MicroPostRepository $microPostRepo
    ): Response
    {
        // dd($microPostRepo->findAll());
        
        // $microPost = new MicroPost();
        // $microPost->setTitle('Welcome to Netherlands');
        // $microPost->setText('The Netherlands is a fantastic country to visit. We are also praying for it.');
        // $microPost->setCreated(new \DateTime());
        
        $microPost = $microPostRepo->find(1);
        $microPost->setTitle("Hearty welcome to Belgium");        
        
        $em->persist($microPost);
        $em->flush();

        $this->addFlash('success', 'Update of MicroPost successfful');

        return $this->render('micro_post/index.html.twig', [
            'controller_name' => 'MicroPostController',
        ]);
    }
}
