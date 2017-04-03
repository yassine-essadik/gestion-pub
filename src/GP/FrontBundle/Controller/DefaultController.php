<?php

namespace GP\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GP\GestionBundle\Entity\Projet;

class DefaultController extends Controller
{
    public function indexAction()
    {
		$em = $this->getDoctrine()->getManager();
		$projets = $em->getRepository('GPGestionBundle:Projet')->findAll();
		
        return $this->render('GPFrontBundle:Default:index.html.twig', array('projets' => $projets));
    }
}
