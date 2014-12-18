<?php


namespace OC\FOSUserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * FOSUser
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="OC\FOSUserBundle\Entity\FOSUserRepository")
 */
class FOSUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


     public function __construct()
    {
        parent::__construct();
        // your own logic
    }
	
	
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
