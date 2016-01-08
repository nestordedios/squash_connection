<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
	public function getLostMatches($slug)
	{
		return $this->getEntityManager()
			->createQuery(
				"SELECT COUNT(m.id) as lost
				FROM AppBundle:Match as m 
				WHERE (m.player1 = $slug and m.resultPlayer1 = 'LOST') or (m.player2 = $slug and m.resultPlayer2 = 'LOST')"
			)
			->getResult();
	}

	public function getWonMatches($slug)
	{
		return $this->getEntityManager()
			->createQuery(
				"SELECT COUNT(m.id) as won
				FROM AppBundle:Match as m
				WHERE (m.player1 = $slug and m.resultPlayer1 = 'WON') or (m.player2 = $slug and m.resultPlayer2 = 'WON')"
			)
			->getResult();
	}

}