<?php

namespace GP\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GP\GestionBundle\Entity\Societe;
use GP\GestionBundle\Form\SocieteType;
use Symfony\Component\HttpFoundation\Request;
use GP\GestionBundle\Entity\Pointvente;
use GP\GestionBundle\Form\PointventeType;

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
}
