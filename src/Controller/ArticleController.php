<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{


    /**
     *@Route("/article/ajouter",name="app_article_ajouter")
     */
    public function addArticle(Request $request,ArticleRepository $repo){

        // création instance article
        $article = new Article();
        // creation du formulaire
        $articleForm = $this->createForm(ArticleType::class,$article);
        // recup 
        $articleForm->handleRequest($request);

        if($articleForm->isSubmitted() ){
            $repo->add($article,true);
        }

        return $this->render("article/ajouter.html.twig",
            ["articleForm"=>$articleForm->createView()]
        );
    }















    /**
     * @Route("/article/{id}", name="app_article")
     */
    public function index(ArticleRepository $repo,$id): Response
    {
        return $this->render('article/index.html.twig',
        ["article"=>$repo->find($id)] );
    }


    /**
     * @Route("/article/search/{name}", requirements={"name"="[a-zA-Z]+"}, name="app_article_name")
     */
    public function search(ArticleRepository $repo,$name): Response
    {
        dd($repo->findByName($name));
        return $this->render('article/index.html.twig');
    }

    /**
     * @Route("/article/search/{op}/{price}",requirements={ "op"="[a-zA-Z]{2}","price"="[0-9]+\.{0,1}[0-9]*"}, name="app_article_price")
     */
    public function searchPrice(ArticleRepository $repo,$price,$op): Response
    {   
        dd($repo->findByPrice($price,$op));
        return $this->render('article/index.html.twig');
    }    


}
