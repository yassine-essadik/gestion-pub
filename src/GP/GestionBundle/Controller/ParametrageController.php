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
use GP\GestionBundle\Entity\Campagne;
use GP\GestionBundle\Form\CampagneType;
use GP\GestionBundle\Entity\Client;
use GP\GestionBundle\Form\ClientType;

class ParametrageController extends Controller
{
    public function indexAction()
    {
        return $this->render('GPGestionBundle:Parametrage:index.html.twig');
    }
    
    public function societesAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$items = $em->getRepository('GPGestionBundle:Societe')->findAll();
    	
    	return $this->render('GPGestionBundle:Parametrage:societes.html.twig' , array('items' => $items));
    	
    }
    
    public function societeAction($id=null, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	if(!empty($id))
    	{
    		$societe = $em->getRepository('GPGestionBundle:Societe')->find($id);
    		if (empty($societe)) 
    		{
    			throw new NotFoundHttpException("L'enregistrement d'id ".$id." n'existe pas.");
    		}
    	}
    	else
    	{
    		$societe = new Societe();
    	}
    	
    	$form   = $this->get('form.factory')->create(SocieteType::class, $societe);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		
    		$em->persist($societe);
    		$em->flush();
    		$request->getSession()->getFlashBag()->clear();
    		$request->getSession()->getFlashBag()->add('notice', 'Elément bien enregistré.');

    		return $this->redirectToRoute('gb_gestion_bundle_parametrage_societes_edit', array('id' => $societe->getId()));
    	}
    	
    	return $this->render('GPGestionBundle:Parametrage:societe.html.twig', array(
    			'form' => $form->createView(), 'item' => $societe
    	));
    	 
    }
    
    public function pointventesAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	 
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
    
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    
    		$em->persist($item);
    		$em->flush();
    		$request->getSession()->getFlashBag()->clear();
    		$request->getSession()->getFlashBag()->add('notice', 'Elément bien enregistré.');
    
    		return $this->redirectToRoute('gb_gestion_bundle_parametrage_pointventes_edit', array('id' => $item->getId()));
    	}
    	 
    	return $this->render('GPGestionBundle:Parametrage:pointvente.html.twig', array(
    			'form' => $form->createView(), 'item' => $item
    	));
    
    }
    
    
    public function chefsAction()
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$items = $em->getRepository('GPGestionBundle:Chef')->findAll();
    
    	return $this->render('GPGestionBundle:Parametrage:chefs.html.twig' , array('items' => $items));
    
    }
    
    public function chefAction($id=null, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    
    	if(!empty($id))
    	{
    		$item = $em->getRepository('GPGestionBundle:Chef')->find($id);
    		if (empty($item))
    		{
    			throw new NotFoundHttpException("L'enregistrement d'id ".$id." n'existe pas.");
    		}
    	}
    	else
    	{
    		$item = new Chef();
    	}
    
    	$form   = $this->get('form.factory')->create(ChefType::class, $item);
    
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    
    		$em->persist($item);
    		$em->flush();
    		$request->getSession()->getFlashBag()->clear();
    		$request->getSession()->getFlashBag()->add('notice', 'Elément bien enregistré.');
    
    		return $this->redirectToRoute('gb_gestion_bundle_parametrage_chefs_edit', array('id' => $item->getId()));
    	}
    
    	return $this->render('GPGestionBundle:Parametrage:chef.html.twig', array(
    			'form' => $form->createView(), 'item' => $item
    	));
    
    }


    public function poseursAction()
    {
    	$em = $this->getDoctrine()->getManager();
    
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
    
    		$em->persist($item);
    		$em->flush();
    		$request->getSession()->getFlashBag()->clear();
    		$request->getSession()->getFlashBag()->add('notice', 'Elément bien enregistré.');
    
    		return $this->redirectToRoute('gb_gestion_bundle_parametrage_poseurs_edit', array('id' => $item->getId()));
    	}
    
    	return $this->render('GPGestionBundle:Parametrage:poseur.html.twig', array(
    			'form' => $form->createView(), 'item' => $item
    	));
    
    }

    public function campagnesAction()
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$items = $em->getRepository('GPGestionBundle:Campagne')->findAll();
    
    	return $this->render('GPGestionBundle:Parametrage:campagnes.html.twig' , array('items' => $items));
    
    }
    
    public function campagneAction($id=null, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    
    	if(!empty($id))
    	{
    		$item = $em->getRepository('GPGestionBundle:Campagne')->find($id);
    		if (empty($item))
    		{
    			throw new NotFoundHttpException("L'enregistrement d'id ".$id." n'existe pas.");
    		}
    	}
    	else
    	{
    		$item = new Campagne();
    	}
    
    	$form   = $this->get('form.factory')->create(CampagneType::class, $item);
    
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    
    		$em->persist($item);
    		$em->flush();
    		$request->getSession()->getFlashBag()->clear();
    		$request->getSession()->getFlashBag()->add('notice', 'Elément bien enregistré.');
    
    		return $this->redirectToRoute('gb_gestion_bundle_parametrage_campagnes_edit', array('id' => $item->getId()));
    	}
    
    	return $this->render('GPGestionBundle:Parametrage:campagne.html.twig', array(
    			'form' => $form->createView(), 'item' => $item
    	));
    
    }
    
    
    public function clientsAction()
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$items = $em->getRepository('GPGestionBundle:Client')->findAll();
    
    	return $this->render('GPGestionBundle:Parametrage:clients.html.twig' , array('items' => $items));
    
    }
    
    public function clientAction($id=null, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    
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
    
    		$em->persist($item);
    		$em->flush();
    		$request->getSession()->getFlashBag()->clear();
    		$request->getSession()->getFlashBag()->add('notice', 'Elément bien enregistré.');
    
    		return $this->redirectToRoute('gb_gestion_bundle_parametrage_clients_edit', array('id' => $item->getId()));
    	}
    
    	return $this->render('GPGestionBundle:Parametrage:client.html.twig', array(
    			'form' => $form->createView(), 'item' => $item
    	));
    
    }
}
