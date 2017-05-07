<?php

namespace GP\PoseurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
    	echo 'test';die;
        return $this->render('GPPoseurBundle:Default:index.html.twig');
    }
}
