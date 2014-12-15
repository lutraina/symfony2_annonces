<?php
// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse; 
use Symfony\Component\HttpFoundation\JsonResponse;

class AdvertController extends Controller
{
    public function indexAction()
    {
    	//methode longue
		// On veut avoir l'URL de l'annonce d'id 5.
        $url = $this->get('router')->generate(
            'oc_platform_view', // 1er argument : le nom de la route
            array('id' => 5)    // 2e argument : les valeurs des paramètres
        );
		 		
		// Méthode courte
		$url2 = $this->generateUrl('oc_platform_home');
		
		$url3 = $this->get('router')->generate(
		    'oc_platform_home', array(), true);
		

		echo($url);
		echo '</br>';
		echo($url2);
		echo '</br>';
		echo($url3);
		
        $content = $this->get('templating')->render('OCPlatformBundle:Advert:index.html.twig', 
        array(
        'nom' => 'winzou'
		));
		
    	return new Response($content);
    }
	
  // La route fait appel à OCPlatformBundle:Advert:view,
  // on doit donc définir la méthode viewAction.
  // On donne à cette méthode l'argument $id, pour
  // correspondre au paramètre {id} de la route
  // On injecte la requête dans les arguments de la méthode
  public function viewAction($id)
  {
    // On récupère notre paramètre tag
    /*$tag = $request->query->get('tag');
    return new Response(
      "Affichage de l'annonce d'id : ".$id.", avec le tag : ".$tag
    );*/
    
    //méthode longue ne s'utilise pas
    // On crée la réponse sans lui donner de contenu pour le moment
   /* $response = new Response;
    // On définit le contenu
    $response->setContent("Ceci est une page d'erreur 404");
    // On définit le code HTTP à « Not Found » (erreur 404)
    $response->setStatusCode(Response::HTTP_NOT_FOUND);
    // On retourne la réponse
    return $response;*/
	
	
	// On utilise le raccourci : il crée un objet Response
    // Et lui donne comme contenu le contenu du template
    /*return $this->get('templating')->renderResponse(
      'OCPlatformBundle:Advert:index.html.twig',
      array('id'  => $id)
    );*/
    
    $url = $this->get('router')->generate('oc_platform_home');
    

    /*return $this->render(
      'OCPlatformBundle:Advert:index.html.twig',
      array('id'  => $id, 'url' => $url)
    );*/
	
    //return new RedirectResponse($url);
	//return $this->redirect($url);
	
	$response = new Response(json_encode(array('id' => $id)));
    // Ici, nous définissons le Content-type pour dire au navigateur
    // que l'on renvoie du JSON et non du HTML
    $response->headers->set('Content-Type', 'application/json');
    //return $response;
	return new JsonResponse(array('id' => $id));
  }
  
  // On récupère tous les paramètres en arguments de la méthode
    public function viewSlugAction($slug, $year, $format)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au
            slug '".$slug."', créée en ".$year." et au format ".$format."."
        );
    }
	
  // On récupère tous les paramètres en arguments de la méthode
    public function viewMonthAction($month, $year, $day)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au
            mois '".$month."', créée en '".$year."', le jour '".$day."."
        );
    }
  
}