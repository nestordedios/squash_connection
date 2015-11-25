<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="club")
 */
class Club implements UserInterface, \Serializable
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * @ORM\Column(type="string")
     * @Assert\NotBlank()
	 */
	protected $clubName;
	
	/**
	 * @ORM\Column(type="string")
     * @Assert\NotBlank()
	 */
	protected $ownerName;
	
	/**
	 * @ORM\Column(type="string")
     * @Assert\NotBlank()
	 */
	protected $ownerLastName;
	
	/**
	 * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     * @Assert\Email
	 */
	protected $email;
	
	/**
	 * @ORM\Column(type="date")
     * @Assert\Date()
	 */
	protected $foundationDate;
	
	/**
	 * @ORM\Column(type="string") 
     * @Assert\NotBlank()
	 */
	 protected $password;
	 
	 /**
	  * @ORM\Column(type="string")
      * @Assert\Country()
	  */
	 protected $country;
	  
	 /**
	  * @ORM\Column(type="string")
      * @Assert\NotBlank()
	  */
	 protected $city;
	  
	 /**
	   * @ORM\Column(type="string")
       * @Assert\NotBlank()
       * @Assert\Length(min=4, max=6)
	   */
	 protected $postCode;
		
     /**
	   * @ORM\Column(type="string")
       * @Assert\NotBlank()
	   */
	 protected $address;
		 
	 /**
	  * @ORM\Column(type="integer")
      * @Assert\Regex("/\d/")
      * @Assert\NotBlank()
	  */
	 protected $amountCourts;

     /**
     * @ORM\Column(name="status", type="string")
     */
     protected $status;

     /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="club")
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set clubName
     *
     * @param string $clubName
     *
     * @return Club
     */
    public function setClubName($clubName)
    {
        $this->clubName = $clubName;

        return $this;
    }

    /**
     * Get clubName
     *
     * @return string
     */
    public function getClubName()
    {
        return $this->clubName;
    }

    /**
     * Set ownerName
     *
     * @param string $ownerName
     *
     * @return Club
     */
    public function setOwnerName($ownerName)
    {
        $this->ownerName = $ownerName;

        return $this;
    }

    /**
     * Get ownerName
     *
     * @return string
     */
    public function getOwnerName()
    {
        return $this->ownerName;
    }

    /**
     * Set ownerLastName
     *
     * @param string $ownerLastName
     *
     * @return Club
     */
    public function setOwnerLastName($ownerLastName)
    {
        $this->ownerLastName = $ownerLastName;

        return $this;
    }

    /**
     * Get ownerLastName
     *
     * @return string
     */
    public function getOwnerLastName()
    {
        return $this->ownerLastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Club
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
     * Set foundationDate
     *
     * @param string $foundationDate
     *
     * @return Club
     */
    public function setFoundationDate($foundationDate)
    {
        $this->foundationDate = $foundationDate;

        return $this;
    }

    /**
     * Get foundationDate
     *
     * @return string
     */
    public function getFoundationDate()
    {
        return $this->foundationDate;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Club
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
     * Set country
     *
     * @param string $country
     *
     * @return Club
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
     * @return Club
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
     * Set postCode
     *
     * @param string $postCode
     *
     * @return Club
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return string
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Club
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set amountCourts
     *
     * @param string $amountCourts
     *
     * @return Club
     */
    public function setAmountCourts($amountCourts)
    {
        $this->amountCourts = $amountCourts;

        return $this;
    }

    /**
     * Get amountCourts
     *
     * @return string
     */
    public function getAmountCourts()
    {
        return $this->amountCourts;
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
     * Add user
     *
     * @param \AppBundle\Entity\Usuario $user
     *
     * @return Club
     */
    public function addUser(\AppBundle\Entity\Usuario $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\Usuario $user
     */
    public function removeUser(\AppBundle\Entity\Usuario $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function __toString() {
        return $this->clubName;
    }

}
