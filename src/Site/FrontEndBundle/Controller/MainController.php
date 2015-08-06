<?php

namespace Site\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SiteFrontEndBundle:Default:index.html.twig', array('name' => $name));
    }
     
    public function aboutAction() 
    {
        $em=$this->get('doctrine.orm.entity_manager');
        $category=$em->getRepository('SiteFrontEndBundle:Category')->findAll();
        $tags=$em->getRepository('SiteFrontEndBundle:Tags')->findAll();
        return $this->render('SiteFrontEndBundle::about.html.twig', array('category'=>$category, 'tags'=>$tags));
        
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
    
    public function dataAction() 
    {
        $request = $this->getRequest();
        $data = $request->get('data');
        $posts=$this->get('PostManager')->createPost($data);
        return $this->redirectToRoute('about_page');
        
    }

    
}
