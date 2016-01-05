<?php  
namespace AppBundle\Entity;
use Doctrine\ORM\EntityRepository;
class MatchRepository extends \Doctrine\ORM\EntityRepository
{
	public function findUserMatches($userId)
	{
		return $this->getEntityManager()
			->createQuery(
				"Select m.id, c.clubName, m.date, m.time, p1.name as player1Name, p1.lastName as player1lastName, p2.name as player2Name, p2.lastName as player2lastName, m.status 
				FROM AppBundle:Match as m 
				join AppBundle:User as p1 with p1.id = m.player1 
				join AppBundle:User as p2 with p2.id = m.player2 
				join AppBundle:Club as c with c.id = m.club 
				where m.player2 = $userId or m.player1 = $userId "
			)
			->getResult();
	}
	public function findPlayedMatches($userId)
	{
		return $this->getEntityManager()
			->createQuery(
				"Select m.id, c.clubName, m.date, m.time, p1.name as player1Name, p1.lastName as player1lastName, p2.name as player2Name, p2.lastName as player2lastName, m.status 
				FROM AppBundle:Match as m 
				join AppBundle:User as p1 with p1.id = m.player1 
				join AppBundle:User as p2 with p2.id = m.player2 
				join AppBundle:Club as c with c.id = m.club 
				where (m.player2 = $userId or m.player1 = $userId) and m.status = 'Played'"
			)
			->getResult();
	}
}
?>