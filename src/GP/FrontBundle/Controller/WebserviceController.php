<?php

namespace GP\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GP\GestionBundle\Entity\Projet;
use Symfony\Component\HttpFoundation\Request;

class WebserviceController extends Controller
{
    public function loginAction(Request $request)
    {

    	$username = $request->get('username');
    	$password = $request->get('password');
    	
    	$user_manager = $this->get('fos_user.user_manager');
    	$factory = $this->get('security.encoder_factory');
    	
    	$user = $user_manager->findUserByUsername($username);

    	$response = new \stdClass();
    	
		if(!empty($user))
		{
			$encoder = $factory->getEncoder($user);
			 
			if($encoder->isPasswordValid($user->getPassword(),$password,$user->getSalt()))
			{
				$em = $this->getDoctrine()->getManager();
				$poseur = $em->getRepository('GPGestionBundle:Poseur')->findOneByUser($user->getId());
				if(!empty($poseur))
				{
					$response->success = true;
					$response->id = $poseur->getId();
					$response->nom = $poseur->getNom();
					$response->prenom = $poseur->getPrenom();
					$response->telephone = $poseur->getTelephone();
				}
				else 
				{
					$response->success = false;
					$response->message = "Poseur introuvable.";
				}
			}
			else
			{
				$response->success = false;
				$response->message = "Mot de passe invalide.";
			}			
		}
		else 
		{
			$response->success = false;
			$response->message = "Utilisateur introuvable.";
		}
    	//{"success":true,"id":"281","name":"Commercial","email":"contactshoppinn@gmail.com","token":"c357d30bbf2bc48d2c4eef0b60f1a3c39367258ddf4ac3f464aec01451880318a76b8fb88d63c372"}
		header('Content-Type: application/json');
    	echo json_encode($response);
    	exit;
    }
    
    public function listAction(Request $request)
    {
    	$id = $request->get('id');
    	
    	$em = $this->getDoctrine()->getManager();
    	$poseur = $em->getRepository('GPGestionBundle:Poseur')->findOneById($id);
    	
    	$response = new \stdClass();
    	
    	if(!empty($poseur))
    	{
    		$response->success = true;
    		$items = $em->getRepository('GPGestionBundle:Intervention')->getListByPoseur($id);

    		$list = array();
    		foreach ($items as $item)
    		{
				$intervention = new \stdClass();
				$intervention->id = $item->getId();
				$intervention->title = $item->getType() . ' : ' . $item->getProjet()->getPointvente();
				$intervention->date_start = $item->getDateDebut();
				$intervention->date_end = $item->getDateFin();
				
				$list[] = $intervention;
    		}
    		
    		$response->list = $list;
    	}
    	else
    	{
    		$response->success = false;
    		$response->message = "Poseur introuvable.";
    	}
    	
    	header('Content-Type: application/json');
    	echo json_encode($response);
    	exit;
    }

    public function interventionAction(Request $request)
    {
    	$id = $request->get('id');
    	$poseur = $request->get('poseur');
    	
    	$em = $this->getDoctrine()->getManager();
    	$poseur = $em->getRepository('GPGestionBundle:Poseur')->findOneById($poseur);
    	 
    	$response = new \stdClass();
    	 
    	if(!empty($poseur))
    	{
    		
    		$item = $em->getRepository('GPGestionBundle:Intervention')->findOneById($id);
    
    		if(!empty($item))
    		{
    			$response->success = true;
    			
    			$intervention = new \stdClass();
    			$intervention->id = $item->getId();
    			$intervention->title = $item->getType() . ' : ' . $item->getProjet()->getPointvente();
    			$intervention->date_start = $item->getDateDebut();
    			$intervention->date_end = $item->getDateFin();
    			$intervention->projet = $item->getProjet()->getNom();
    			$intervention->laissez_passer_valide = $item->getLaissezPasserValide();
    			$intervention->contact_urgence = $item->getContactUrgence();
    			$intervention->statut = $item->getStatut()->getNom();
    			
    			$response->intervention = $intervention;    			
    			
    		}
    		else 
    		{
    			$response->success = false;
    			$response->message = "Intervention introuvable.";
    		}

    	}
    	else
    	{
    		$response->success = false;
    		$response->message = "Poseur introuvable.";
    	}
    	 
    	header('Content-Type: application/json');
    	echo json_encode($response);
    	exit;
    }
    
}
