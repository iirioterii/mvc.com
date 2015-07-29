<?php

namespace Site\FrontEndBundle\Service;

class SortManager 
{
    protected $container;
    
    function __construct($container) 
    {
        $this->container=$container; //передаем $container в конструктор
    }
    
    /*
     * Get Posts by Slug(string)
     */
    public function getPostsByTag($slug)
    {
        $posts=  $this->getEm()
                      ->getRepository('SiteFrontEndBundle:Tags')
                      ->findOneBySlug($slug)
                      ->getPosts();
            return $posts;
        
    }
    
    /*
     * Get Posts by Category(string)
     */
    public function getPostsByCategory($slug)
    {
        $posts= $this->getEm()
                     ->getRepository('SiteFrontEndBundle:Category')
                     ->findOneBySlug($slug)
                     ->getPosts();
             dump($posts);
                     
            return $posts;
    }
    
    /*
     * Вызов Doctrine: Entity Manager
     */
    private function getEm() {
        return $this->container->get('doctrine.orm.entity_manager');
    }
}


