<?php

namespace GP\GestionBundle\Repository;

/**
 * InterventionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InterventionRepository extends \Doctrine\ORM\EntityRepository
{
	
	public function getListByPoseur($id, $today_show)
	{
		$today = new \DateTime() ;
		$today_date = $today->format('Y-m-d 00:00:00');
		$today_date_end = $today->format('Y-m-d 23:59:59');
		
		$qb = $this->createQueryBuilder('i');
		$qb->join('i.poseurs', 'p')
		->where($qb->expr()->eq('p.id', $id));

		if($today_show)
			$qb->where("i.dateDebut >= '" . $today_date . "' AND i.dateDebut <= '" . $today_date_end ."'");
		else 
			$qb->where("i.dateDebut < '" . $today_date . "'");
			
		$qb->orderBy('i.dateDebut');
		return $qb->getQuery()->getResult();
	}

	public function getListByClientStatut($id, $statut, $projet)
	{
		$qb = $this->createQueryBuilder('i');
		$qb->join('i.projet', 'p')
		->join('p.client', 'c')
		->where($qb->expr()->eq('c.id', $id))
		->andWhere($qb->expr()->eq('i.statut', $statut));
		if(!empty($projet))
			$qb->andWhere($qb->expr()->eq('p.id', $projet));
		$qb->groupBy('i.id');
		
		$result = $qb->getQuery()->getResult();
		
		return $result;
	}
}
