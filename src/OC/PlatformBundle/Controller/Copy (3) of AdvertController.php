<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use OC\PlatformBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Response;
use OC\PlatformBundle\Entity\Application;
use OC\PlatformBundle\Entity\AdvertSkill;

class AdvertController extends Controller
{
  public function indexAction($page)
  {
  	
	
	
	/*$em = $this->getDoctrine()->getManager();

	// On crée une nouvelle annonce
	$advert1 = new Advert;
	$advert1->setTitle('Recherche développeur.');
	$advert1->setAuthor('Carol');
	$advert1->setContent("Pour mission courte");
	$advert1->setDate(new \Datetime());
	// Et on le persiste
	$em->persist($advert1);
	
	// On récupère l'annonce d'id 1. On n'a pas encore vu cette méthode find(),
	// mais elle est simple à comprendre. Pas de panique, on la voit en détail
	// dans un prochain chapitre dédié aux repositories
	$advert2 = $em->getRepository('OCPlatformBundle:Advert')->find(2);
	
	// On modifie cette annonce, en changeant la date à la date d'aujourd'hui
	//$advert2->setDate(new \Datetime());
	$advert2->setTitle('mama');*/
	
	
	
	
	
	
	// Ici, pas besoin de faire un persist() sur $advert2. En effet, comme on a
	// récupéré cette annonce via Doctrine, il sait déjà qu'il doit gérer cette
	// entité. Rappelez-vous, un persist ne sert qu'à donner la responsabilité
	// de l'objet à Doctrine.
	
	// Enfin, on applique les deux changements à la base de données :
	// Un INSERT INTO pour ajouter $advert1
	// Et un UPDATE pour mettre à jour la date de $advert2
	/*$em->flush();*/
	
	
	
 



	//$em = $this->getDoctrine()->getManager();
	//$advertRepository = $em->getRepository('OCPlatformBundle:Advert');

	

    // On ne sait pas combien de pages il y a
    // Mais on sait qu'une page doit être supérieure ou égale à 1
    /*if ($page == 1) {
    	$contenu = $this->renderView('OCPlatformBundle:Advert:email.txt.twig', array(
		  'var1' => 'oi',
		  'var2' => 'oi2'
		));*/
		// Puis on envoie l'e-mail, par exemple :
		//mail('contact@lucianahembert.com', 'Inscription OK', $contenu);

      // On déclenche une exception NotFoundHttpException, cela va afficher
      // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
      
   // } else throw new NotFoundHttpException('Page "'.$page.'" inexistante.');

    // Ici, on récupérera la liste des annonces, puis on la passera au template

    
    // Mais pour l'instant, on ne fait qu'appeler le template
   // return $this->render('OCPlatformBundle:Advert:index.html.twig');
   
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
		
   //SERVICE
   // On a donc accès au conteneur :
    $mailer = $this->container->get('mailer'); 
   
   
   // Notre liste d'annonce en dur
    $listAdvertsOriginel = array(
      array(
        'title'   => 'Recherche développpeur Symfony2',
        'id'      => 1,
        'author'  => 'Alexandre',
        'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Mission de webmaster',
        'id'      => 2,
        'author'  => 'Hugo',
        'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Offre de stage webdesigner',
        'id'      => 3,
        'author'  => 'Mathieu',
        'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
        'date'    => new \Datetime())
    );
	$em = $this->getDoctrine()->getManager();
	$listAdverts = $em->getRepository('OCPlatformBundle:Advert')->findAll();
	
	
   return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
  'listAdverts' => $listAdverts
));

  }

  public function contactAction()
  {
  	 return $this->render('OCPlatformBundle:Advert:view.html.twig');
  }
  		
  public function menuAction($limit)
  {
    // On fixe en dur une liste ici, bien entendu par la suite
    // on la récupérera depuis la BDD !
    $listAdverts = array(
      array('id' => 2, 'title' => 'Recherche développeur Symfony2'),
      array('id' => 5, 'title' => 'Mission de webmaster'),
      array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );
    return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe
      // les variables nécessaires au template !
      'listAdverts' => $listAdverts
    ));
  }

  public function addAction(Request $request)
  {
    // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

    // On récupère le service
   // $antispam = $this->container->get('oc_platform.antispam');

    // Je pars du principe que $text contient le texte d'un message quelconque
    /*$text = 'azer azer a';
    if ($antispam->isSpam($text)) {
      throw new \Exception('Votre message a été détecté comme spam !');
    }
	*/
	
	// Création de l'entité
    $advert = new Advert();
    $advert->setTitle('Recherche développeur Symfony2.');
    $advert->setAuthor('Luciana');
    $advert->setContent("Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…");
    $advert->setDate(new \Datetime());
	
	 // Création d'une première candidature
    $application1 = new Application();
    $application1->setAuthor('Marine');
    $application1->setContent("J'ai toutes les qualités requises.");
	$application1->setDate(new \Datetime());
    // Création d'une deuxième candidature par exemple
    $application2 = new Application();
    $application2->setAuthor('Pierre');
    $application2->setContent("Je suis très motivé.");
    // On lie les candidatures à l'annonce
    $application1->setAdvert($advert);
    $application2->setAdvert($advert);
	$application2->setDate(new \Datetime());
	
	 // Création de l'entité Image
    $image = new Image();
    $image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
    $image->setAlt('Job de rêve');
    // On lie l'image à l'annonce
    $advert->setImage($image);
	
	
    // On peut ne pas définir ni la date ni la publication,
    // car ces attributs sont définis automatiquement dans le constructeur

    // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();




// On récupère toutes les compétences possibles
    $listSkills = $em->getRepository('OCPlatformBundle:Skill')->findAll();
    // Pour chaque compétence
    foreach ($listSkills as $skill) {
      // On crée une nouvelle « relation entre 1 annonce et 1 compétence »
      $advertSkill = new AdvertSkill();
      // On la lie à l'annonce, qui est ici toujours la même
      $advertSkill->setAdvert($advert);
      // On la lie à la compétence, qui change ici dans la boucle foreach
      $advertSkill->setSkill($skill);
      // Arbitrairement, on dit que chaque compétence est requise au niveau 'Expert'
      $advertSkill->setLevel('Expert');
      // Et bien sûr, on persiste cette entité de relation, propriétaire des deux autres relations
      $em->persist($advertSkill);
    }
	
	
	
    // Étape 1 : On « persiste » l'entité
    $em->persist($advert);
	
	// Étape 1 bis : pour cette relation pas de cascade lorsqu'on persiste Advert, car la relation est
    // définie dans l'entité Application et non Advert. On doit donc tout persister à la main ici.
    $em->persist($application1);
    $em->persist($application2);

    // Étape 2 : On « flush » tout ce qui a été persisté avant
    $em->flush();
	
    // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
    if ($request->isMethod('POST')) {
      // Ici, on s'occupera de la création et de la gestion du formulaire

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      // Puis on redirige vers la page de visualisation de cettte annonce
      //return $this->redirect($this->generateUrl('oc_platform_view', array('id' => 5)));
      return $this->redirect($this->generateUrl('oc_platform_view', array('id' => $advert->getId())));
   

    }

    // Si on n'est pas en POST, alors on affiche le formulaire
    return $this->render('OCPlatformBundle:Advert:add.html.twig');
  }

  public function editAction($id, Request $request)
  {
    
    $em = $this->getDoctrine()->getManager();
    // On récupère l'annonce $id
    $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);
    if (null === $advert) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }
    // La méthode findAll retourne toutes les catégories de la base de données
    $listCategories = $em->getRepository('OCPlatformBundle:Category')->findAll();
    // On boucle sur les catégories pour les lier à l'annonce
    foreach ($listCategories as $category) {
      $advert->addCategory($category);
    }
    // Pour persister le changement dans la relation, il faut persister l'entité propriétaire
    // Ici, Advert est le propriétaire, donc inutile de la persister car on l'a récupérée depuis Doctrine
    // Étape 2 : On déclenche l'enregistrement
    $em->flush();
    
   
   
   
 	$advert = array(
      'title'   => 'Recherche développpeur Symfony2',
      'id'      => $id,
      'author'  => 'Alexandre',
      'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
      'date'    => new \Datetime()
    );

    return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
      'advert' => $advert
    ));
  }

  public function deleteAction($id)
  {
  	
	$em = $this->getDoctrine()->getManager();
    // On récupère l'annonce $id
    $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);
    if (null === $advert) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }
    // On boucle sur les catégories de l'annonce pour les supprimer
    foreach ($advert->getCategories() as $category) {
      $advert->removeCategory($category);
    }
    // Pour persister le changement dans la relation, il faut persister l'entité propriétaire
    // Ici, Advert est le propriétaire, donc inutile de la persister car on l'a récupérée depuis Doctrine
    // On déclenche la modification
    $em->flush();
	
    // Ici, on récupérera l'annonce correspondant à $id

    // Ici, on gérera la suppression de l'annonce en question

    return $this->render('OCPlatformBundle:Advert:delete.html.twig');
  }
  
  public function viewAction($id)
  {
  	
	$em = $this->getDoctrine()->getManager();
    // On récupère l'annonce $id
    $advert = $em
      ->getRepository('OCPlatformBundle:Advert')
      ->find($id)
    ;

    // $advert est donc une instance de OC\PlatformBundle\Entity\Advert
    // ou null si l'id $id  n'existe pas, d'où ce if :
    if (null === $advert) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }

     /*
	
	
    $advert = array(
      'title'   => 'Recherche développpeur Symfony2',
      'id'      => $id,
      'author'  => 'Alexandre',
      'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
      'date'    => new \Datetime()
    );*/
    
    
    // On récupère la liste des candidatures de cette annonce
    $listApplications = $em
      ->getRepository('OCPlatformBundle:Application')
      ->findBy(array('advert' => $advert))
    ;

	// On récupère maintenant la liste des AdvertSkill
    $listAdvertSkills = $em
      ->getRepository('OCPlatformBundle:AdvertSkill')
      ->findBy(array('advert' => $advert))
    ;
    return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
      'advert'           => $advert,
      'listApplications' => $listApplications,
      'listAdvertSkills' => $listAdvertSkills
    ));
    
  }


	public function editImageAction()
	{
	  $em = $this->getDoctrine()->getManager();
	  // On récupère l'annonce
	  $advert = $em->getRepository('OCPlatformBundle:Advert')->find(7);
	  // On modifie l'URL de l'image par exemple
	  $advert->getImage()->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
	  // On n'a pas besoin de persister l'annonce ni l'image.
	  // Rappelez-vous, ces entités sont automatiquement persistées car
	  // on les a récupérées depuis Doctrine lui-même
	  
	  // On déclenche la modification
	  $em->flush();
	  return new Response('OK');
	}
	
	

}