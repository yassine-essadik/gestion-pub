<?php

namespace GP\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GP\GestionBundle\Entity\Projet;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$user = $this->get('security.token_storage')->getToken()->getUser();
    	
		$em = $this->getDoctrine()->getManager();
		
		$client = $em->getRepository('GPGestionBundle:Client')->findOneByUser($user->getId());
		
		$projets = array();
		if(!empty($client))
			$projets = $em->getRepository('GPGestionBundle:Projet')->findBy(array('client' => $client->getId()));
		
        return $this->render('GPFrontBundle:Default:index.html.twig', array('projets' => $projets));
    }
}
