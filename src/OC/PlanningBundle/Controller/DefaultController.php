<?php

namespace OC\PlanningBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
    	// On récupère le service
	    $antispam = $this->container->get('main_core.antispam');
	
	    // Je pars du principe que $text contient le texte d'un message quelconque
	    $text = 'azer azer a';
	    if ($antispam->isSpam($text)) {
	      throw new \Exception('Votre message a été détecté comme spam !');
	    }
		
		
		// On récupère le service
	    $antispam2 = $this->container->get('oc_planning.InputValidator');
	
	    // Je pars du principe que $text contient le texte d'un message quelconque
	    $email = 'contact@lucianahembert.com';
	    if (!$antispam2->emailValidator($email)) {
	      throw new \Exception('Votre adresse email est incorrecte');
	    }
		
		// On récupère le service
	    $antispam2 = $this->container->get('oc_planning.InputValidator');
	
	    // Je pars du principe que $text contient le texte d'un message quelconque
	    $email = '69001';
	    if ($antispam2->code_postal($email)) {
	      throw new \Exception('Votre code postal est incorrect');
	    }
		
		
		
        return $this->render('OCPlanningBundle:Default:index.html.twig', array('name' => $name));
    }
}
