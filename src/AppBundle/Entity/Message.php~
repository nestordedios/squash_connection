<?php  
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MessageRepository")
 * @ORM\Table(name="Message")
 */
class Message
{
	/**
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	* @ORM\Column(name="sender_id", type="integer")
	* @ORM\ManyToOne(targetEntity="User")
    * @ORM\JoinColumn(name="sender_id", referencedColumnName="id")
	*/
	protected $sender_id;

	/**
	* @ORM\Column(name="receiver_id", type="integer")
	* @ORM\ManyToOne(targetEntity="User")
	* @ORM\JoinColumn(name="receiver_id", referencedColumnName="id")
	*/
	protected $receiver_id;

	/**
	* @ORM\Column(name="status", type="integer")
	*/
	protected $status;

	/**
	* @ORM\Column(name="message_type", type="integer", nullable=true)
	*/
	protected $message_type;

	/**
	* @ORM\Column(name="message", type="string")
	*/
	protected $message;

	/**
	* @ORM\Column(name="date", type="datetime")
	*/
	protected $date;

	/**
	* @ORM\Column(name="type", type="string", nullable=true)
	*/
	protected $type;


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
     * Set senderId
     *
     * @param integer $senderId
     *
     * @return Message
     */
    public function setSenderId($senderId)
    {
        $this->sender_id = $senderId;

        return $this;
    }

    /**
     * Get senderId
     *
     * @return integer
     */
    public function getSenderId()
    {
        return $this->sender_id;
    }

    /**
     * Set receiverId
     *
     * @param integer $receiverId
     *
     * @return Message
     */
    public function setReceiverId($receiverId)
    {
        $this->receiver_id = $receiverId;

        return $this;
    }

    /**
     * Get receiverId
     *
     * @return integer
     */
    public function getReceiverId()
    {
        return $this->receiver_id;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Message
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set messageType
     *
     * @param integer $messageType
     *
     * @return Message
     */
    public function setMessageType($messageType)
    {
        $this->message_type = $messageType;

        return $this;
    }

    /**
     * Get messageType
     *
     * @return integer
     */
    public function getMessageType()
    {
        return $this->message_type;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Message
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Message
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
     * Set type
     *
     * @param string $type
     *
     * @return Message
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
