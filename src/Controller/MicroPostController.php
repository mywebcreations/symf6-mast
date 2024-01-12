<?php

namespace App\Controller;

use App\Repository\MicroPostRepository;
use App\Entity\MicroPost;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(
        EntityManagerInterface $em, 
        MicroPostRepository $microPostRepo
    ): Response
    {
        $posts = $microPostRepo->findAll();
        
        // $microPost = new MicroPost();
        // $microPost->setTitle('Welcome to Netherlands');
        // $microPost->setText('The Netherlands is a fantastic country to visit. We are also praying for it.');
        // $microPost->setCreated(new \DateTime());
        
        // $microPost = $microPostRepo->find(1);
        // $microPost->setTitle("Hearty welcome to Belgium");        
        
        // $em->persist($microPost);
        // $em->flush();

        // $this->addFlash('success', 'Update of MicroPost successfful');

        return $this->render(
            'micro_post/index.html.twig', [
               'posts' => $posts
            ]
        );
    }

    #[Route('/micro-post/{post}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $post): Response
    {
        return $this->render(
            'micro_post/show-one.html.twig', [
               'post' => $post
            ]
        );
    }

    #[Route('/micro-post/create/new', name: 'app_micro_post_create_new')]
    public function createPost(Request $request, EntityManagerInterface $entityManager): Response
    {
        $microPost = new MicroPost();
        $form = $this->createFormBuilder($microPost)
            ->add('title')
            ->add('text')
            ->add('submit', SubmitType::class, ['label' => 'Submit'])
            ->getForm();
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $microPost->setTitle($data->getTitle());
            $microPost->setText($data->getText());
            $microPost->setCreated(new DateTime());

            $entityManager->persist($microPost);
            $entityManager->flush();
        }
        
        return $this->render('micro_post/create-post.html.twig', [
            'form' => $form->createView(), //or $form->createView()
        ]);
    }

}
