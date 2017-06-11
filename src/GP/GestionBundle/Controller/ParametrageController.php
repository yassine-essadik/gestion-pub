<?php

namespace GP\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GP\GestionBundle\Entity\Societe;
use GP\GestionBundle\Form\SocieteType;
use Symfony\Component\HttpFoundation\Request;
use GP\GestionBundle\Entity\Pointvente;
use GP\GestionBundle\Form\PointventeType;
use GP\GestionBundle\Entity\Chef;
use GP\GestionBundle\Form\ChefType;
use GP\GestionBundle\Entity\Poseur;
use GP\GestionBundle\Form\PoseurType;
use GP\GestionBundle\Form\CampagneType;
use GP\GestionBundle\Entity\Client;
use GP\GestionBundle\Form\ClientType;

class ParametrageController extends Controller
{
    public function indexAction()
    {
        return $this->render('GPGestionBundle:Parametrage:index.html.twig');
    }
    
    
    public function pointventesAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	 
    	// Delete Items
    	if ($request->isMethod('POST'))
    	{
    		$task = $request->get('task');
    		 
    		switch($task)
    		{
    			case 'delete':
    				$cid = $request->get('cid');
    				if(!empty($cid))
    				{
    					foreach ($cid as $one)
    					{
    						$item_delete = $em->getRepository('GPGestionBundle:Pointvente')->find($one);
    						$em->remove($item_delete);
    					}
    					$em->flush();
    				}
    				$request->getSession()->getFlashBag()->clear();
    				$request->getSession()->getFlashBag()->add('notice', 'Les éléments ont bien été supprimés.');
    				break;
    		}
    		 
    	}
    	//
    	
    	$items = $em->getRepository('GPGestionBundle:Pointvente')->findAll();
    	 
    	return $this->render('GPGestionBundle:Parametrage:pointventes.html.twig' , array('items' => $items));
    	 
    }
    
    public function pointventeAction($id=null, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	 
    	if(!empty($id))
    	{
    		$item = $em->getRepository('GPGestionBundle:Pointvente')->find($id);
    		if (empty($item))
    		{
    			throw new NotFoundHttpException("L'enregistrement d'id ".$id." n'existe pas.");
    		}
    	}
    	else
    	{
    		$item = new Pointvente();
    	}
    	
    	$form   = $this->get('form.factory')->create(PointventeType::class, $item);
    	//var_dump($form->handleRequest($request)->isValid());die;
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    
    		$em->persist($item);
    		$em->flush();
    		$request->getSession()->getFlashBag()->clear();
    		$request->getSession()->getFlashBag()->add('notice', 'Elément bien enregistré.');
    
    		//return $this->redirectToRoute('gb_gestion_bundle_parametrage_pointventes_edit', array('id' => $item->getId()));
    		return $this->redirectToRoute('gb_gestion_bundle_parametrage_pointventes');
    		
    	}
    	 
    	return $this->render('GPGestionBundle:Parametrage:pointvente.html.twig', array(
    			'form' => $form->createView(), 'item' => $item
    	));
    
    }
    
   
    public function poseursAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    
    	// Delete Items
    	if ($request->isMethod('POST'))
    	{
    		$task = $request->get('task');
    		 
    		switch($task)
    		{
    			case 'delete':
    				$cid = $request->get('cid');
    				if(!empty($cid))
    				{
    					foreach ($cid as $one)
    					{
    						$item_delete = $em->getRepository('GPGestionBundle:Poseur')->find($one);
    						$em->remove($item_delete);
    					}
    					$em->flush();
    				}
    				$request->getSession()->getFlashBag()->clear();
    				$request->getSession()->getFlashBag()->add('notice', 'Les éléments ont bien été supprimés.');
    				break;
    		}
    		 
    	}
    	//
    	
    	$items = $em->getRepository('GPGestionBundle:Poseur')->findAll();
    
    	return $this->render('GPGestionBundle:Parametrage:poseurs.html.twig' , array('items' => $items));
    
    }
    
    public function poseurAction($id=null, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    
    	if(!empty($id))
    	{
    		$item = $em->getRepository('GPGestionBundle:Poseur')->find($id);
    		if (empty($item))
    		{
    			throw new NotFoundHttpException("L'enregistrement d'id ".$id." n'existe pas.");
    		}
    	}
    	else
    	{
    		$item = new Poseur();
    	}
    
    	$form   = $this->get('form.factory')->create(PoseurType::class, $item);
    
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    
    		$user = $item->getUser();
    		$user->setEnabled(true);
    		$user->setRoles(array('ROLE_ADMIN'));
    		
    		$em->persist($item);
    		$em->flush();
    		$request->getSession()->getFlashBag()->clear();
    		$request->getSession()->getFlashBag()->add('notice', 'Elément bien enregistré.');
    
    		//return $this->redirectToRoute('gb_gestion_bundle_parametrage_poseurs_edit', array('id' => $item->getId()));
    		return $this->redirectToRoute('gb_gestion_bundle_parametrage_poseurs');
    		
    	}
    
    	return $this->render('GPGestionBundle:Parametrage:poseur.html.twig', array(
    			'form' => $form->createView(), 'item' => $item
    	));
    
    }
 
    public function clientsAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    
    	// Delete Items
    	if ($request->isMethod('POST'))
    	{
    		$task = $request->get('task');
    		 
    		switch($task)
    		{
    			case 'delete':
    				$cid = $request->get('cid');
    				if(!empty($cid))
    				{
    					foreach ($cid as $one)
    					{
    						$item_delete = $em->getRepository('GPGestionBundle:Client')->find($one);
    						$em->remove($item_delete);
    					}
    					$em->flush();
    				}
    				$request->getSession()->getFlashBag()->clear();
    				$request->getSession()->getFlashBag()->add('notice', 'Les éléments ont bien été supprimés.');
    				break;
    		}
    		 
    	}
    	//
    	
    	$items = $em->getRepository('GPGestionBundle:Client')->findAll();
    
    	return $this->render('GPGestionBundle:Parametrage:clients.html.twig' , array('items' => $items));
    
    }
    
    public function clientAction($id=null, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$userManager = $this->get('fos_user.user_manager');
    	
    	if(!empty($id))
    	{
    		$item = $em->getRepository('GPGestionBundle:Client')->find($id);
    		if (empty($item))
    		{
    			throw new NotFoundHttpException("L'enregistrement d'id ".$id." n'existe pas.");
    		}
    	}
    	else
    	{
    		$item = new Client();
    	}
    
    	$form   = $this->get('form.factory')->create(ClientType::class, $item);
    
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		
    		$user = $item->getUser();
    		$user->setEnabled(true);
    		$user->setRoles(array('ROLE_ADMIN'));
			
    		$em->persist($item);
    		$em->flush();
    		$request->getSession()->getFlashBag()->clear();
    		$request->getSession()->getFlashBag()->add('notice', 'Elément bien enregistré.');
    
    		//return $this->redirectToRoute('gb_gestion_bundle_parametrage_clients_edit', array('id' => $item->getId()));
    		return $this->redirectToRoute('gb_gestion_bundle_parametrage_clients');
    		
    	}
    
    	return $this->render('GPGestionBundle:Parametrage:client.html.twig', array(
    			'form' => $form->createView(), 'item' => $item
    	));
    
    }
}
