<?php

namespace GP\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlanningController extends Controller
{
    public function indexAction()
    {
        return $this->render('GPGestionBundle:Planning:index.html.twig');
    }
    
    
    public function interventionsAction()
    {
    	return $this->render('GPGestionBundle:Planning:interventions.html.twig');
    }
    
    public function projetsAction()
    {
    	return $this->render('GPGestionBundle:Planning:projets.html.twig');
    }
    
    public function planningAction()
    {
    	return $this->render('GPGestionBundle:Planning:planning.html.twig');
    }
}
