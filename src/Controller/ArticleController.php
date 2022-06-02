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
     * @Route("/article/{id}", name="app_article")
     */
    public function index(ArticleRepository $repo,$id): Response
    {
        return $this->render('article/index.html.twig',
        ["article"=>$repo->find($id)] );
    }


    /**
     * @Route("/article/search/{name}", name="app_article")
     */
    public function search(ArticleRepository $repo,$name): Response
    {
        dd($repo->findByName($name));
        return $this->render('article/index.html.twig');
    }


}
