<?php

namespace GP\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GP\GestionBundle\Entity\Projet;

class WebserviceController extends Controller
{
    public function loginAction()
    {

    	//{"success":true,"id":"281","name":"Commercial","email":"contactshoppinn@gmail.com","token":"c357d30bbf2bc48d2c4eef0b60f1a3c39367258ddf4ac3f464aec01451880318a76b8fb88d63c372"}
    	$response = new \stdClass();
    	$response->success = true;
    	
    	echo json_encode($response);
    	exit;
    }
}
