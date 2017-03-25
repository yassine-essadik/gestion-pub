<?php

namespace GP\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GP\GestionBundle\Entity\Societe;
use GP\GestionBundle\Form\SocieteType;
use Symfony\Component\HttpFoundation\Request;

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
    
    public function societeAction($id, Request $request)
    {
    	$societe = new Societe();
    	$form   = $this->get('form.factory')->create(SocieteType::class, $societe);
    	
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($societe);
    		$em->flush();
    	
    		$request->getSession()->getFlashBag()->add('notice', 'Item bien enregistré.');
    	}
    	
    	return $this->render('GPGestionBundle:Parametrage:societe.html.twig', array(
    			'form' => $form->createView(),
    	));
    	 
    }
}
