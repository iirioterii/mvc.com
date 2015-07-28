<?php
// src/Acme/DemoBundle/Admin/PostAdmin.php

namespace Site\FrontEndBundle\Admin;


use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends BaseAdmin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('category')
            ->add('tags')
            ->add('title', null, array('label' => 'Заголовок'))
            ->add('preview', null, array('label'=>'Краткое описание'))
            ->add('content', null, array('label'=>'Текст новости'))
            ->add('created',null, array('label'=>'Дата'))
            
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('created')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('preview')
            ->add('created')
            
            
        ;
    }
    
    //Закидываю title в slug
    function prePersist($object) {
        $object->setSlug($this->transliterate($object->getTitle()));
    }
}