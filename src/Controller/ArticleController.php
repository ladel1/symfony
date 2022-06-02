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
     * @Route("/article1", name="app_article1")
     */
    public function index1(): Response
    {
        // 1ere méthode
        // recup entitymanager
        $em = $this->getDoctrine()->getManager();
        // new Article
        $a = new Article();
        $a->setName("Iphone 13");
        $a->setPrice(1200);
        $em->persist($a);
        $em->flush();




        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }


    /**
     * @Route("/article2", name="app_article2")
     */
    public function index2(EntityManagerInterface $em ): Response
    {
        // 2eme méthode
        // new Article
        $a = new Article();
        $a->setName("Samsung S22 5G");
        $a->setDescription("blablabla");
        $a->setPrice(900);
        $em->persist($a);
        $em->flush();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    // 3 méthode

    /**
     * @Route("/article3", name="app_article3")
     */
    public function index3(ArticleRepository $articleRepo): Response
    {
        // 2eme méthode
        // new Article
        $a = new Article();
        $a->setName("Ecran Dell");
        $a->setDescription("blablabla");
        $a->setPrice(150);
        $articleRepo->add($a,true);

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }


    // 1ere méthode lire un article
    /**
     * @Route("/lire-article",name="app_lire_article")
     */
    public function oneArticle(ArticleRepository $articleRepo):Response{
        //dd($articleRepo->find(3));
        //dd($articleRepo->findAll());
        dd($articleRepo->findBy(["price"=>800]));
    }

    // 2eme méthode lire un article
    /**
     * @Route("/lire-article2",name="app_lire_article2")
     */
    public function oneArticle2():Response{
        $articleRepo = $this->getDoctrine()->getRepository(Article::class);
        dd($articleRepo->find(3));
    }    

    // 3eme méthode lire un article
    /**
     * @Route("/lire-article3",name="app_lire_article3")
     */
    public function oneArticle3():Response{
        $em = $this->getDoctrine()->getManager();
        $articleRepo = $em->getRepository(Article::class);
        dd($articleRepo->find(1));
    }


}
