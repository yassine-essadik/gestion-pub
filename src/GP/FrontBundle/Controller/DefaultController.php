<?php

namespace GP\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GP\GestionBundle\Entity\Projet;
use GP\GestionBundle\Entity\InterventionType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
    	$projet_selected = $request->get('filter_projet', '');
    	
    	$user = $this->get('security.token_storage')->getToken()->getUser();
    	
		$em = $this->getDoctrine()->getManager();
		
		$client = $em->getRepository('GPGestionBundle:Client')->findOneByUser($user->getId());
		
		$data = array();
		$status_name = array();
		$projets = array();
		
		if(!empty($client))
		{
			$projets = $em->getRepository('GPGestionBundle:Projet')->findBy(array('client' => $client->getId()));
			
			$status_intervention = $em->getRepository('GPGestionBundle:InterventionStatut')->findAll();
			

			foreach ($status_intervention as $statut)
			{
				$interventions = $em->getRepository('GPGestionBundle:Intervention')->getListByClientStatut($client->getId(), $statut->getId(), $projet_selected);
				$data[$statut->getId()] = count($interventions);
				$status_name[$statut->getId()] = $statut->getNom();
			}
			
		}
			
		
        return $this->render('GPFrontBundle:Default:index.html.twig', array('projets' => $projets, 'data' => $data, 'status_name' => $status_name, 'projet_selected' => $projet_selected));
    }
}
