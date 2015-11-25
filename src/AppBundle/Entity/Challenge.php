<?php 
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Table(name="challenge")
* @ORM\Entity(repositoryClass="AppBundle\Entity\ChallengeRepository")
*/
class Challenge
{
	/**
	* @ORM\Column(name="id", type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
	* @ORM\Column(name="player1", type="integer")
	* @ORM\ManyToOne(targetEntity="Usuario")
	*/
	protected $player1;

	/**
	* @ORM\Column(name="player2", type="integer")
	* @ORM\ManyToOne(targetEntity="Usuario")
	*/
	protected $player2;

	/**
	* @ORM\Column(name="club", type="integer")
	* @ORM\ManyToOne(targetEntity="Club")
	*/
	protected $club;

	/**
	* @ORM\Column(name="date", type="date")
	*/
	protected $date;

	/**
	* @ORM\Column(name="time", type="datetime")
	*/
	protected $time;

	/**
	* @ORM\Column(name="message", type="string")
	*/
	protected $message;

	/**
	* @ORM\Column(name="published_date", type="datetime")
	*/
	protected $publishedDate;

	/**
	* @ORM\Column(name="status", type="string", nullable=true)
	*/
	protected $status;

    /**
    * @ORM\OneToMany(targetEntity="Usuario", mappedBy="challenges")
    */
    protected $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * Set player2
     *
     * @param integer $player2
     *
     * @return Challenge
     */
    public function setPlayer2($player2)
    {
        $this->player2 = $player2;

        return $this;
    }

    /**
     * Get player2
     *
     * @return integer
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * Set club
     *
     * @param string $club
     *
     * @return Challenge
     */
    public function setClub($club)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return string
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Challenge
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Challenge
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Challenge
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set publishedDate
     *
     * @param \DateTime $publishedDate
     *
     * @return Challenge
     */
    public function setPublishedDate($publishedDate)
    {
        $this->publishedDate = $publishedDate;

        return $this;
    }

    /**
     * Get publishedDate
     *
     * @return \DateTime
     */
    public function getPublishedDate()
    {
        return $this->publishedDate;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Challenge
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

    /**
     * Set player1
     *
     * @param integer $player1
     *
     * @return Challenge
     */
    public function setPlayer1($player1)
    {
        $this->player1 = $player1;

        return $this;
    }

    /**
     * Get player1
     *
     * @return integer
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\Usuario $user
     *
     * @return Challenge
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
}
