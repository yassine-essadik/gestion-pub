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
		header('Content-Type: application/json');
    	echo json_encode($response);
    	exit;
    }
    
    public function listAction(Request $request)
    {
    	$id = $request->get('id');
    	$today = $request->get('today', 0);
    	$em = $this->getDoctrine()->getManager();
    	$poseur = $em->getRepository('GPGestionBundle:Poseur')->findOneById($id);
    	
    	$response = new \stdClass();
    	
    	if(!empty($poseur))
    	{
    		$response->success = true;
    		$items = $em->getRepository('GPGestionBundle:Intervention')->getListByPoseur($id, $today);

    		$list = array();
    		foreach ($items as $item)
    		{
				$intervention = new \stdClass();
				$intervention->id = $item->getId();
				$intervention->title = $item->getType() . ' : ' . $item->getProjet()->getPointvente();
				$intervention->date_start = $item->getDateDebut();
				$intervention->date_end = $item->getDateFin();
				$intervention->projet = $item->getProjet()->getNom();
				$intervention->laissez_passer_valide = $item->getLaissezPasserValide();
				$intervention->contact_urgence = $item->getContactUrgence();
				$intervention->statut = $item->getStatut()->getNom();
				$intervention->latitude = $item->getProjet()->getPointvente()->getLatitude();
				$intervention->longitude = $item->getProjet()->getPointvente()->getLongitude();
				$intervention->adresse = $item->getProjet()->getPointvente()->getAdresse();
				
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

    public function planningAction(Request $request)
    {
    	$id = $request->get('id');
    	$em = $this->getDoctrine()->getManager();
    	$poseur = $em->getRepository('GPGestionBundle:Poseur')->findOneById($id);
    	 
    	$items = array();
    	if(!empty($poseur))
    	{
    		$items = $em->getRepository('GPGestionBundle:Intervention')->getListByPoseur($id, false, true);
    	}
    	 
    	return $this->render('GPFrontBundle:Webservice:planning.html.twig', array('items' => $items));
    	 
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
    			$intervention->image_avant = $this->getParameter('intervention_images_url').'/'. $item->getImageAvant();
    			$intervention->image_apres = $this->getParameter('intervention_images_url').'/'. $item->getImageApres();
    			$intervention->projet = $item->getProjet()->getNom();
    			$intervention->laissez_passer_valide = $item->getLaissezPasserValide();
    			$intervention->contact_urgence = $item->getContactUrgence();
    			$intervention->statut = $item->getStatut()->getNom();
    			$intervention->latitude = $item->getProjet()->getPointvente()->getLatitude();
    			$intervention->longitude = $item->getProjet()->getPointvente()->getLongitude();
    			$intervention->adresse = $item->getProjet()->getPointvente()->getAdresse();
    			
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
    
    
    
    public function saveAction(Request $request)
    {
    	$id = $request->get('id');
    	
    	$response = new \stdClass();
    	
    	if(!empty($id))
    	{
    		
    		$em = $this->getDoctrine()->getManager();
    		$intervention = $em->getRepository('GPGestionBundle:Intervention')->find($id);
    		
    		if (empty($intervention))
    		{
    			$response->success = false;
    			$response->message = "L'enregistrement d'id ".$id." n'existe pas.";
    		}
    		else
    		{
    			$commentaire = $request->get('commentaire');
    			$statut = $request->get('statut');
    			
    			$intervention->setCommentaire($commentaire);
    			
    			$InterventionStatut = $em->getRepository('GPGestionBundle:InterventionStatut')->find($statut);
    			$intervention->setStatut($InterventionStatut);
    			
    			$uploaddir = $this->getParameter('intervention_images_directory').'/';
    			
    			if(!empty($_FILES['image_avant']) && $_FILES['image_avant']['error'] == 0)
    			{
    				$filename = $_FILES['image_avant']['name'];
    				$ext = pathinfo($filename, PATHINFO_EXTENSION);
    				
    				$uploadfile = md5(uniqid()).'.'.$ext;
    				 
    				if(move_uploaded_file($_FILES['image_avant']['tmp_name'], $uploaddir. $uploadfile))
    				{
    					$intervention->setImageAvant($uploadfile);
    				}
    			}

    			 
    			if(!empty($_FILES['image_apres']) && $_FILES['image_apres']['error'] == 0)
    			{
    				$filename = $_FILES['image_apres']['name'];
    				$ext = pathinfo($filename, PATHINFO_EXTENSION);
    				
    				$uploadfile =  md5(uniqid()).'.'.$ext;
    				
    				if(move_uploaded_file($_FILES['image_apres']['tmp_name'], $uploaddir. $uploadfile))
    				{
    					$intervention->setImageApres($uploadfile);
    				}
    			}
    			
    			$em->persist($intervention);
    			$em->flush();
    			
    			$response->success = true;
    		}
    		
    	}
    	else
    	{
    		$response->success = false;
    		$response->message = "ID intervention obligatoire.";
    	}
    	header('Content-Type: application/json');
    	echo json_encode($response);
    	exit;
    }
}
