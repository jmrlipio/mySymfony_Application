<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Jone\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
	   $em = $this->getDoctrine()->getManager();
       $entities = $em->getRepository('JoneBlogBundle:Property')
       ->findLatestPropertybyId(); 
        $entities2 = $em->getRepository('JoneBlogBundle:Property')->findAll();
        
        return $this->render('JoneBlogBundle:Page:index.html.twig', array(
            'entities' => $entities, 'entities2' => $entities2, 
            ));
    }
}
?>
