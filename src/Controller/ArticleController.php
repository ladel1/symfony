<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{


    /**
     *@Route("/article/ajouter",name="app_ajouterartilce")
     */
    public function addArticle(Request $request,ArticleRepository $repo){    
        

        // check if is connected else redirect to login
        if($this->getUser()==null){
            return $this->redirectToRoute("app_connexion");
        }        

        // création instance article
        $article = new Article();
        // creation du formulaire
        $articleForm = $this->createForm(ArticleType::class,$article);
        // traitement
        // recup 
        $articleForm->handleRequest($request);

        if($articleForm->isSubmitted() && $articleForm->isValid()){
            $repo->add($article,true);
            $this->addFlash("success","l'article à bien été créé");
            return $this->redirectToRoute("app_listearticle");
        }

        return $this->render("article/ajouter.html.twig",
            ["articleForm"=>$articleForm->createView()]
        );
    }


    /**
     *  @Route("/article/modifier/{id}",  name="app_article_update",requirements={"id"="\d+"})
     */
    public function update(Article $article,Request $request,EntityManagerInterface $em){
        // check if is connected else redirect to login
        if($this->getUser()==null){
            return $this->redirectToRoute("app_connexion");
        }           
        // creation du formulaire
        $articleForm = $this->createForm(ArticleType::class,$article);
        $articleForm->handleRequest($request);
        if($articleForm->isSubmitted()  && $articleForm->isValid()){
            $em->flush();
            // ajouter un message
            $this->addFlash("success","l'article à bien été modifié");
            return $this->redirectToRoute("app_listearticle");
        }
        return $this->render("article/modifier.html.twig",["articleForm"=>$articleForm->createView()]);
    }


    /**
     * @Route("/article/liste",name="app_listearticle")
     */
    public function list(ArticleRepository $repo){
        
        $artilces = $repo->joinArticleUtilisateur();
        return $this->render("article/list.html.twig",
        [
            "articles"=>$artilces
        ]
    );
    }


    /**
     * @Route("/article/supprimer/{id}", name="app_article_remove",requirements={"id"="\d+"})
     */
    public function remove(ArticleRepository $repo,$id=null){
        // check if is connected else redirect to login
        if($this->getUser()==null){
            return $this->redirectToRoute("app_connexion");
        }          
        if($id!=null){
            $article = $repo->find($id);
            $repo->remove($article,true);
            $this->addFlash("success","l'article à bien été supprimé");
        }
        return $this->redirectToRoute("app_listearticle");
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
