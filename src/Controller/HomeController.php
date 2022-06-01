<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/azertyui",name="app_accueil")
     */
    public function index():Response{
        $a = "Home";
        return $this->render("pages/home.html.twig",["title" => $a]);
    }


    /**
     * @Route("/blog",name="app_blog")
     */
    public function blog():Response{
        return $this->render("pages/blog.html.twig");

    }    

    /**
     * @Route("/contact",name="app_contact")
     */
    public function contact():Response{
        return $this->render("pages/contact.html.twig");
    }  
    
    
    /**
     * @Route("/a-propos",name="app_apropos")
     */
    public function apropos():Response{
        // redirct("app_blog")
        return $this->render("pages/apropos.html.twig");
    }  



    /**
     * @Route("/calc",name="app_calc")
     */
    public function calc(Request $request):Response{
        $op1 = $request->query->get("op1");
        
        $result=$op1;
        return $this->render("pages/calc.html.twig",["result"=>$result]);
    } 




}