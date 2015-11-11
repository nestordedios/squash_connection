<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario implements UserInterface, \Serializable
{
	/**
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank()
	 */
	protected $name;
	
	/**
	 * @ORM\Column(name="lastName", type="string")
     * @Assert\NotBlank()
	 */
	protected $lastName;
	
	/**
	 * @ORM\Column(name="email", type="string", unique=true)
     * @Assert\Email()
     * @Assert\NotBlank()
	 */
	protected $email;
	
	/**
	 * @ORM\Column(name="password", type="string")
     * @Assert\NotBlank()
	 */
	protected $password;
	
	/**
	 * @ORM\Column(name="playingLevel", type="integer")
     * @Assert\NotBlank(message = "Choose a valid level.")
	 */
	protected $playingLevel;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Gender", inversedBy="users")
     * @ORM\JoinColumn(name="gender", referencedColumnName="code")
     * @Assert\NotBlank(message = "Choose a valid gender.")
	 */
	protected $gender;
	
	/**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="users")
     * @ORM\JoinColumn(name="country", referencedColumnName="code")
	 * 
     * @Assert\NotBlank()
	 */
	protected $country;
	
	/**
	 * @ORM\Column(name="city", type="string")
     * @Assert\NotBlank(message = "Choose a country.")
	 */
	protected $city;
	
	/**
	 * @ORM\Column(name="status", type="string")
	 */
	 protected $status;

	public function getUserName()
	{
		return $this->email;
	}
	
	public function getSalt()
	{
		return null;
	}
	
	public function getRoles()
	{
		return array('ROLE_USER');
	}
	
	public function eraseCredentials()
	{
		
	}
	
	public function serialize()
	{
		return serialize(array(
			$this->id,
			$this->email,
			$this->password,
			//$this->salt
		));
	}
	
	public function unserialize($serialized)
	{
		list(
			$this->id,
			$this->email,
			$this->password,
			//$this->salt
		)= unserialize($serialized);
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
     * Set name
     *
     * @param string $name
     *
     * @return Usuario
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Usuario
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set playingLevel
     *
     * @param integer $playingLevel
     *
     * @return Usuario
     */
    public function setPlayingLevel($playingLevel)
    {
        $this->playingLevel = $playingLevel;

        return $this;
    }

    /**
     * Get playingLevel
     *
     * @return integer
     */
    public function getPlayingLevel()
    {
        return $this->playingLevel;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Usuario
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Usuario
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Usuario
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Usuario
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
