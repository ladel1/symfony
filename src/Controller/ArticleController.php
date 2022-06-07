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
        // traitement
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
     * @Route("/article/liste",name="app_listearticle")
     */
    public function list(ArticleRepository $repo){
        return $this->render("article/list.html.twig",
        [
            "articles"=>$repo->findAll()
        ]
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




}
