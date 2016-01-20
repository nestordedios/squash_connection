<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MessageRepository extends \Doctrine\ORM\EntityRepository
{
	
	public function getUserMessages($userId)
	{		
        return $this->getEntityManager()
			->createQuery(
				"SELECT a.id, a.status, a.message, a.sender_id, us.name as nameSender, us.lastName as lastNameSender, a.receiver_id, ur.name as nameReceiver, ur.lastName as lastNameReceiver, a.date 
				FROM AppBundle:Message a 
				INNER JOIN AppBundle:Message b   
				WITH a.sender_id = b.sender_id AND a.receiver_id = b.receiver_id AND a.date = b.date
				INNER JOIN AppBundle:User us 
				WITH a.sender_id = us.id 
				INNER JOIN AppBundle:User ur 
				WITH a.receiver_id = ur.id 
				WHERE a.receiver_id = $userId
				ORDER BY a.date DESC"
			)
			->getResult();
	}

	public function getMessageById($messageId)
	{		
        return $this->getEntityManager()
			->createQuery(
				"SELECT a.id, a.message, a.sender_id, us.name as nameSender, us.lastName as lastNameSender, a.receiver_id, ur.name as nameReceiver, ur.lastName as lastNameReceiver, a.date 
				FROM AppBundle:Message a 
				INNER JOIN AppBundle:Message b   
				WITH a.sender_id = b.sender_id AND a.receiver_id = b.receiver_id AND a.date = b.date
				INNER JOIN AppBundle:User us 
				WITH a.sender_id = us.id 
				INNER JOIN AppBundle:User ur 
				WITH a.receiver_id = ur.id 
				WHERE a.id = $messageId
				ORDER BY a.date DESC"
			)
			->getResult();
	}

	public function getChallengeMessages($challengeId)
	{		
        return $this->getEntityManager()
			->createQuery(
				"SELECT a.id, a.message, a.sender_id, us.name as nameSender, us.lastName as lastNameSender, a.receiver_id, ur.name as nameReceiver, ur.lastName as lastNameReceiver, a.date 
				FROM AppBundle:Message a 
				INNER JOIN AppBundle:Message b   
				WITH a.sender_id = b.sender_id AND a.receiver_id = b.receiver_id AND a.date = b.date
				INNER JOIN AppBundle:User us 
				WITH a.sender_id = us.id 
				INNER JOIN AppBundle:User ur 
				WITH a.receiver_id = ur.id 
				WHERE a.type = $challengeId
				ORDER BY a.date ASC"
			)
			->getResult();
	}

}
//	( SELECT sender_id, receiver_id, MAX(date) AS MaxSentDate 
//	FROM 
?>