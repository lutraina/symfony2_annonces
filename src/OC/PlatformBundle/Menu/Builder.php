<?php
// src/Acme/DemoBundle/Menu/Builder.php
namespace OC\PlatformBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

class Builder extends ContainerAware
{
    public function menu(FactoryInterface $factory, array $options)
    {
    
		$nav = array(
    		'Infos Pratiques'=>array(
    			'oc_platform_home'=>'Accueil',
    			'oc_platform_add'=>'Contact',
    		),
    		'Mon cv'=>array(
    			'oc_platform_home'=>'CV en PDF',
    		),
    		
    	);
		
		
		$request = $this->container->get('request');
        $routeName = $request->get('_route');
		
		
		$menu = $factory->createItem('root');
        //ul de la liste nav list du menu,
        $menu->setChildrenAttributes(array('class' => 'nav nav-list'));
        foreach ($nav AS $item => $children) {
            //chaque section
            if (is_numeric($item)) {
                $menu->addChild($item)->setAttribute('class', 'divider');
            } else {
                $menu->addChild($item)->setAttribute('class', 'nav-header');
            }
            foreach ($children AS $route => $name) {
                $menu->addChild($name, array('route' => $route));
				
				if ($routeName == $route) {
                    $menu[$name]->setAttribute('class', 'active');
                }
            }
        }
 
        return $menu;
		
		
    }
}