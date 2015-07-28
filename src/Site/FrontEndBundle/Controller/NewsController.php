<?php

namespace Site\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{

    public function mainAction($page) 
    {
        
        $em=$this->get('doctrine.orm.entity_manager');
        $posts=$em->getRepository('SiteFrontEndBundle:Post')
                  ->findAll();
        $paginator=  $this->GET('knp_paginator');
        $data=$paginator->paginate($posts, $page, 3);
        $count=$em->getRepository('SiteFrontEndBundle:Post')
                     ->counter();
        dump($count);
        return $this->render('SiteFrontEndBundle::main.html.twig', array('posts'=>$data));
    }
    
    public function tagsBySlugAction($slug)
    {
        $posts=  $this->get('TagsManager')->getPostsByTag($slug);
        dump($posts);
        return $this->render('SiteFrontEndBundle::news_by_tag.html.twig', array('posts'=>$posts));
    }
    
        public function postsAction($slug)
    {
       $em=$this->get('doctrine.orm.entity_manager');
       $posts=$em->getRepository('SiteFrontEndBundle:Post')
                 ->findOneBySlug($slug);
         dump($posts);
        return $this->render('SiteFrontEndBundle::post_by_slug.html.twig');
    }
    
}
