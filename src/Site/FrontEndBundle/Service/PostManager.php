<?php

namespace Site\FrontEndBundle\Service;

use Site\FrontEndBundle\Entity\Post;

class PostManager 
{
    protected $container;
    
    function __construct($container) 
    {
        $this->container=$container; //передаем $container в конструктор
    }
         public function transliterate($rus)	
    {
	$tr = array(
            "А"=>"a",            "Б"=>"b",            "В"=>"v",            "Г"=>"g",
            "Д"=>"d",            "Е"=>"e",            "Ё"=>"e",            "Ж"=>"j",
            "З"=>"z",            "И"=>"i",            "Й"=>"y",            "К"=>"k",
            "Л"=>"l",            "М"=>"m",            "Н"=>"n",            "О"=>"o",
            "П"=>"p",            "Р"=>"r",            "С"=>"s",            "Т"=>"t",
            "У"=>"u",            "Ф"=>"f",            "Х"=>"h",            "Ц"=>"ts",
            "Ч"=>"ch",           "Ш"=>"sh",           "Щ"=>"sch",          "Ъ"=>"",
            "Ы"=>"i",            "Ь"=>"j",            "Э"=>"e",            "Ю"=>"yu",
            "Я"=>"ya",           "а"=>"a",            "б"=>"b",            "в"=>"v",
            "г"=>"g",            "д"=>"d",            "е"=>"e",            "ё"=>"e",
            "ж"=>"j",            "з"=>"z",            "и"=>"i",            "й"=>"y",
            "к"=>"k",            "л"=>"l",            "м"=>"m",            "н"=>"n",
            "о"=>"o",            "п"=>"p",            "р"=>"r",            "с"=>"s",
            "т"=>"t",            "у"=>"u",            "ф"=>"f",            "х"=>"h",
            "ц"=>"ts",           "ч"=>"ch",           "ш"=>"sh",           "щ"=>"sch",
            "ъ"=>"y",            "ы"=>"i",            "ь"=>"j",            "э"=>"e",
            "ю"=>"yu",           "я"=>"ya",           " "=> "_",           "."=> "",
            "/"=> "_",           ","=>"_",            "-"=>"_",            "("=>"",
            ")"=>"",             "["=>"",             "]"=>"",             "="=>"_",
            "+"=>"_",            "*"=>"",             "?"=>"",             "\""=>"",
            "'"=>"",             "&"=>"",             "%"=>"",             "#"=>"",
            "@"=>"",             "!"=>"",             ";"=>"",             "№"=>"",
            "^"=>"",             ":"=>"",             "~"=>"",             "\\"=>"",
        );
	return strtr($rus, $tr);
    }
    
    private function getEm() {
        return $this->container->get('doctrine.orm.entity_manager');
    }
    
    public function createPost($data)
    {
        $post=new Post;//создаем объект сущности Post
        $post->setTitle($data['title']); // устанавливаем title из формы
        $post->setPreview($data['preview']); 
        $post->setCreated(new \DateTime());
        $post->setContent($data['content']);
        $post->setSlug($this->transliterate($post->getTitle()));
        $cat=$this->getEm()->getRepository('SiteFrontEndBundle:Category')->find($data['cat']);
        $tags=  $this->getEm()->getRepository('SiteFrontEndBundle:Tags')->find($data['tags']);
        $post->setCategory($cat);
        $post->addTag($tags);
        $this->getEm()->persist($post);
        $this->getEm()->flush();
    }
}
