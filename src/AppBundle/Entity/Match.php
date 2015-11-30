<?php 
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="AppBundle\Entity\MatchRepository")
* @ORM\Table(name="`Match`")
*/
class Match
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $player1;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $player2;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $club;

	/**
	* @ORM\Column(type="date")
	*/
	protected $date;

	/**
	* @ORM\Column(type="datetime")
	*/
	protected $time;

	/**
	* @ORM\Column(type="string", nullable=true)
	*/
	protected $status;

	/**
	* @ORM\Column(type="string", nullable=true)
	*/
	protected $result;



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
     * Set player1
     *
     * @param integer $player1
     *
     * @return Match
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
     * Set player2
     *
     * @param integer $player2
     *
     * @return Match
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
     * @param integer $club
     *
     * @return Match
     */
    public function setClub($club)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return integer
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
     * @return Match
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
     * @return Match
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
     * Set status
     *
     * @param string $status
     *
     * @return Match
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
     * Set result
     *
     * @param string $result
     *
     * @return Match
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }
}
