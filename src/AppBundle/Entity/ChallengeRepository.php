<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
/**
 * ChallengeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ChallengeRepository extends \Doctrine\ORM\EntityRepository
{
	public function findUserChallenges($userId)
	{
		return $this->getEntityManager()
			->createQuery(
				"Select ch.id, c.clubName, ch.date, ch.time, p1.name as player1Name, p1.lastName as player1lastName, p2.name as player2Name, p2.lastName as player2lastName 
				FROM AppBundle:Challenge as ch 
				join AppBundle:User as p1 with p1.id = ch.player1 
				join AppBundle:User as p2 with p2.id = ch.player2 
				join AppBundle:Club as c with c.id = ch.club
				where ch.status is NULL and ch.player2 = $userId"
			)
			->getResult();
	}

	public function findMyChallenges($userId)
	{
		return $this->getEntityManager()
			->createQuery(
				"Select u.name, u.lastName, c.clubName, ch.date, ch.time, ch.id, ch.status 
				from AppBundle:User u, AppBundle:Club c, AppBundle:Challenge ch 
				where ch.player1 = $userId and c.id = ch.club and u.id = ch.player2"
			)
			->getResult();
	}

	public function insertToMatch($idChallenge)
	{
		return $this->getEntityManager()
		->createQuery(
			"Insert into match (player1, player2, club, date, time)
			(Select player1, player2, club, date, time
			from challenge where id = idChallenge)"
		)
		->getResult();
	}

}
