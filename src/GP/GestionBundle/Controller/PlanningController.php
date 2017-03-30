<?php

namespace GP\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GP\GestionBundle\Entity\Projet;
use GP\GestionBundle\Form\ProjetType;
use GP\GestionBundle\Entity\Intervention;
use GP\GestionBundle\Form\InterventionType;
use Symfony\Component\HttpFoundation\Request;


class PlanningController extends Controller
{
    public function indexAction()
    {
        return $this->render('GPGestionBundle:Planning:index.html.twig');
    }
    
    
    public function interventionsAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$items = $em->getRepository('GPGestionBundle:Intervention')->findAll();
    	
    	return $this->render('GPGestionBundle:Planning:interventions.html.twig' , array('items' => $items));
    	
    }
    
    public function interventionAction($id=null, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	if(!empty($id))
    	{
    		$intervention = $em->getRepository('GPGestionBundle:Intervention')->find($id);
    		if (empty($intervention)) 
    		{
    			throw new NotFoundHttpException("L'enregistrement d'id ".$id." n'existe pas.");
    		}
    	}
    	else
    	{
    		$intervention = new Intervention();
    	}
    	
    	$form   = $this->get('form.factory')->create(InterventionType::class, $intervention);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		
    		$em->persist($intervention);
    		$em->flush();
    		$request->getSession()->getFlashBag()->clear();
    		$request->getSession()->getFlashBag()->add('notice', 'Elément bien enregistré.');

    		return $this->redirectToRoute('gb_gestion_bundle_planning_interventions_edit', array('id' => $intervention->getId()));
    	}
    	
    	return $this->render('GPGestionBundle:Planning:intervention.html.twig', array(
    			'form' => $form->createView(), 'item' => $intervention
    	));
    	 
    }
    
    public function projetsAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$items = $em->getRepository('GPGestionBundle:Projet')->findAll();
    	
    	return $this->render('GPGestionBundle:Planning:projets.html.twig' , array('items' => $items));
    	
    }
    
    public function projetAction($id=null, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	if(!empty($id))
    	{
    		$projet = $em->getRepository('GPGestionBundle:Projet')->find($id);
    		if (empty($projet)) 
    		{
    			throw new NotFoundHttpException("L'enregistrement d'id ".$id." n'existe pas.");
    		}
    	}
    	else
    	{
    		$projet = new Projet();
    	}
    	
    	$form   = $this->get('form.factory')->create(ProjetType::class, $projet);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		
    		$em->persist($projet);
    		$em->flush();
    		$request->getSession()->getFlashBag()->clear();
    		$request->getSession()->getFlashBag()->add('notice', 'Elément bien enregistré.');

    		return $this->redirectToRoute('gb_gestion_bundle_planning_projets_edit', array('id' => $projet->getId()));
    	}
    	
    	return $this->render('GPGestionBundle:Planning:projet.html.twig', array(
    			'form' => $form->createView(), 'item' => $projet
    	));
    	 
    }
    
    
    public function planningAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	 
    	$items = $em->getRepository('GPGestionBundle:Intervention')->findAll();
    	
    	return $this->render('GPGestionBundle:Planning:planning.html.twig', array('items' => $items));
    }
}
