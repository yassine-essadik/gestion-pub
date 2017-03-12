<?php

namespace GP\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ParametrageController extends Controller
{
    public function indexAction()
    {
        return $this->render('GPGestionBundle:Parametrage:index.html.twig');
    }
}
