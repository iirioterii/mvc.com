<?php

namespace Site\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SiteFrontEndBundle:Default:index.html.twig', array('name' => $name));
    }
     
    public function aboutAction($slug) 
    {
        $posts=  $this->get('TagsManager')->getPostsByTag($slug);
        dump($posts);
        return $this->render('SiteFrontEndBundle::about.html.twig', array('posts'=>$posts));
        
    }
    
    public function trainingAction() 
    {
        return $this->render('SiteFrontEndBundle::training.html.twig');
    }
    
    public function galleryAction() 
    {
        return $this->render('SiteFrontEndBundle::gallery.html.twig');
    }
    
    public function contactsAction() 
    {
        return $this->render('SiteFrontEndBundle::contacts.html.twig');
    }
    

    
}
