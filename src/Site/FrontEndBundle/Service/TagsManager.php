<?php

namespace Site\FrontEndBundle\Service;

class TagsManager 
{
    protected $container;
    
    function __construct($container) 
    {
        $this->container=$container; //передаем $container в конструктор
    }
    
    /*
     * Get Posts by Slug(string)
     */
    public function getPostsByTag($Slug) {
        $posts=  $this->getEm()
                      ->getRepository('SiteFrontEndBundle:Tags')
                      ->findOneBySlug($Slug)
                      ->getPosts();
        return $posts;
        
    }
    
    /*
     * Вызов Doctrine: Entity Manager
     */
    private function getEm() {
        return $this->container->get('doctrine.orm.entity_manager');
    }
}


