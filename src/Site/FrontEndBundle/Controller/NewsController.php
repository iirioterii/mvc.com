<?php

namespace Site\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{

    public function mainAction($page) 
    {
        
        $em=$this->get('doctrine.orm.entity_manager'); //Получаем сервис контейнер entity_manager
        $posts=$em->getRepository('SiteFrontEndBundle:Post') //Достаем репозиторий сущности и выбираем все записи 
                  ->findAll();
        $paginator=  $this->get('knp_paginator'); //Получаем сервис контейнер knp_paginator
        $data=$paginator->paginate($posts, $page, 3); 
        //$count=$em->getRepository('SiteFrontEndBundle:Post')
                     //->counter();
        return $this->render('SiteFrontEndBundle::main.html.twig', array('posts'=>$data));
    }
    
    public function postsByTagAction($slug, $page)
    {
        $posts=  $this->get('sort_manager')->getPostsByTag($slug);
        $paginator= $this->get('knp_paginator');
        $data=$paginator->paginate($posts, $page, 3);
        return $this->render('SiteFrontEndBundle::main.html.twig', array('posts'=>$data));
    }
    
    public function postsByCatAction($slug, $page)
    {
        $posts= $this->get('sort_manager')->getPostsByCategory($slug);
        $paginator=  $this->get('knp_paginator');
        $data=$paginator->paginate($posts, $page, 3);
        return $this->render('SiteFrontEndBundle::main.html.twig', array('posts'=>$data));
    }
    
    public function postAction($slug)
    {
       $em=$this->get('doctrine.orm.entity_manager');
       $post=$em->getRepository('SiteFrontEndBundle:Post')
                 ->findOneBySlug($slug);
        return $this->render('SiteFrontEndBundle::post_by_slug.html.twig', array('post'=>$post));
    }
    
}
