<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Table(name="user")
 * @ORM\Entity
 *
 */
class User
{
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(name="username", type="string", length=255)
   */
  protected $username;

  /**
   * @ORM\Column(type="datetime",nullable=true)
   * @Gedmo\Timestampable(on="create")
   */
  private $registration_date;


  /**
   * Constructor
   */
  public function __construct()
  {
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

  /**
   * Set username
   *
   * @param string $username
   * @return User
   */
  public function setUsername($username)
  {
    $this->username = $username;

    return $this;
  }

  /**
   * Get username
   *
   * @return string
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * Set registration_date
   *
   * @return User
   */
  public function setRegistrationDate($registration_date)
  {
    $this->registration_date = $registration_date;
    return $this; // fluent interface
  }

  /**
   * Get registration_date
   *
   * @return datetime
   */
  public function getRegistrationDate()
  {
    return $this->registration_date;
  }

}
