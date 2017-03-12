<?php

namespace GP\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OptionsController extends Controller
{
    public function indexAction()
    {
        return $this->render('GPGestionBundle:Options:index.html.twig');
    }
}
