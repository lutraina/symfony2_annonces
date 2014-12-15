<?php
// src/OC/PlatformBundle/Antispam/OCAntispam.php
namespace Main\CoreBundle\Antispam;
class MainAntispam
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
  public function isSpam($text)
  {
  	$lenght = strlen($text);
	if($lenght < $this->minLength) { return false; } else { return true; }
  }
  
}
