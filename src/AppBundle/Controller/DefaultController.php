<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
		// On signe le futur appel a l api en fonction de l url de la page d appel
		$secure = $this->container->get('api.secureapi');
		$signature = $secure->get_signature($request->getUri());
		
		
        return $this->render('default/index.html.twig',['signature'=>$signature]);
    }
	
	
}
