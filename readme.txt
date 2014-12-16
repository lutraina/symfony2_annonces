- Installation de Symfony2 par console :

$ composer create-project symfony/framework-standard-edition path/ "2.3.*"

- Générer un bundle

$ php app/console generate:bundle

(normalement je choisi yml pour pour travailler avec les routes)

- Création d'entité

$ php app/console doctrine:generate:entity

- Création et éventuelle mise à jour de la BDD

(configuration de la BDD est faite dans le fichier app/config/parametres.yml)
$ php app/console doctrine:schema:update —force

PS : dans mon exemple sur Github, il y a des relation @ORM\OneToMany, @ORM\ManyToOne, etc ..
et utilisation de "use Doctrine\Common\Collections\ArrayCollection;"

PS : une commande intéressante est php app/console doctrine:schema:update —dump-sql  pour avoir une meilleur 
vision des rêquetes

- Génération de getters and setters 

$ php app/console doctrine:generate:entities OCPlatformBundle:Advert

PS: pour la génération d'un CRUD de doctrine :
$ php app/console doctrine:generate:crud


PS : pour les jointures, vous avez un exemple dans Entity/AdvertRepository.php



- Assets

Après l'insertion des scripts css et js, comme :

 {% block javascripts %}
        	{% javascripts %}
        		'%kernel.root_dir%/../vendor/components/jquery/jquery.js'
        		'%kernel.root_dir%/../vendor/twbs/bootstrap/dist/js/bootstraps.js'
        		'@PousadaElcapitanBundle/Resources/public/js/clean-blog.js'
        	%}
        	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 			{% endjavascripts %}
  {% endblock %}

on fait une commande pour la construction des fichiers assetics :

$ php app/console assetic:dump
 
 
- Installation des bundles

Dans le fichier composer.json, dans la partie "require", on ajout le chemin pour que le système 
trouve le bundle, et ensuite on l'installe avec composer par la console :

 "require": {
        "php": ">=5.3.3",
        "symfony/symfony": "2.5.*",
        "doctrine/orm": "~2.2,>=2.2.3",
        "doctrine/doctrine-bundle": "~1.2",
        "twig/extensions": "~1.0",
        "symfony/assetic-bundle": "~2.3",
        "symfony/swiftmailer-bundle": "~2.3",
        "symfony/monolog-bundle": "~2.4",
        "sensio/distribution-bundle": "~3.0",
        "sensio/framework-extra-bundle": "~3.0",
        "incenteev/composer-parameter-handler": "~2.0",
        "twbs/bootstrap": "3.2.*",
        "components/jquery »: »1.9.* »,
	    "doctrine/doctrine-fixtures-bundle": "~2.2"	
    }, 
    
    
$ composer update

Ensuite, on ajoute le chemin du bundle dans le fichier AppKernelphp, comme :

$bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();

-  Security.yml

Vous pouvez trouver un exemple de pare-feu, d'associaiton des rôles, logins et mots de passe,  dans une première partie 
définis dans le fichier security.yml, et ensuite venus de la BDD, avec le bundle 
que j'ai crée nommé UserBundle.

- Formulaires

Vous avez des exemples des structures des formulaires d'ajout, etc... dans le bundle 
PlatformBundle. De plus, il y a un exemple d'héritage de formulaire et de formulaire embriqué.

Pour générer les formulaire, j'ai utilisé la commande pour les entités :

$ php app/console doctrine:generate:form OCPlatformBundle:Advert




- Services

pour voir tous les services installés :

$ php app/console container:debug

dans mon exemple, il y a un service qui a été crée pour le Antispam. Il est dans le bundle 
MainCoreBundle, et sers à être utilisé par toute l'application, comme un design pattern
Singleton.


Aussi pour les services, j'ai mis Tags, pour qu'on puisse ajouter des fonctions à Twig.

- Bundles

J'ai fait un MainCoreBundle qui sers à avoir les services et les classes principales de 
l'application.

 

-  Fixtures

J'ai utilisé le bundle fixture de doctrine pour ajouter certains données à la BDD

$ php app/console doctrine:fixtures:load -append

Une fois le bundle est installé, doctrine reconnait cette commande et fait la mise à jour de la BDD 
(--append à la fin, permet l'ajout dans la BDD sans la vider pour complet).


 






