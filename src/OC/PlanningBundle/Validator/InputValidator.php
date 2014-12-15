<?php
// src/OC/PlatformBundle/Antispam/OCAntispam.php
namespace OC\PlanningBundle\Validator;
class InputValidator
{
	
  private $mailer;
  private $locale;
  private $minLength;

  public function __construct(\Swift_Mailer $mailer, $locale, $minLength)
  {
    $this->mailer    = $mailer; //dependency injection, un service dans l'autre
    $this->locale    = $locale; //dependency injection, un service dans l'autre
    $this->minLength = (int) $minLength;
  }
  
  /**
   * Vérifie si le texte est un spam ou non
   *
   * @param string $text
   * @return bool
   */
  public function emailValidator($email)
  {
	return eregi("^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$", $email);
  }

  /**
   * Vérifie si le texte est un spam ou non
   *
   * @param string $text
   * @return bool
   */
  public function code_postal($text)
  {
  	$lenght = strlen($text);
	if( ($lenght >= 6) || ($lenght < 5))  { return true; } else { return false; }
  }
  
   	
}