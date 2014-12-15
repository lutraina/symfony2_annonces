<?php

namespace Main\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
    	
        return $this->render('MainCoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
