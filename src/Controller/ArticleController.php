<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="app_article")
     */
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

        /**
     * @Route("/article", name="app_article")
     */
    public function index2(EntityManagerInterface $em): Response
    {
        $a=new Article();
        $a->setName("Samsum S22");
        $a->setDescription("fdsfrqgsdq");
        $a->setPrice(1000);
        $em->persist($a);
        $em->flush();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    // 1ere méthode lire un article
    /**
     * @Route("/lire-article", name="app_lire_article")
     */
    public function oneArticle(ArticleRepository $articleRepo): Response
    {
        dd($articleRepo->find(1));
    }

    // 2ème méthode lire un article
    /**
     * @Route("/lire-article2", name="app_lire_article2")
     */
    public function oneArticle2(): Response
    {
        $articleRepo = $this->getDoctrine()->getRepository(Article::class);
        dd($articleRepo->find(1));
    }


    
}
