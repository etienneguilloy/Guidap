<?php

namespace APIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
	
	/**
     * @Route("/api/nouveaunombre/{signature}", name="nouveau_nombre")
     */
	public function nouveaunombre($signature)
	{
		$generernombre = $this->container->get('api.generernombre');
		$generernombre->nouveau_nombre();
		return new JsonResponse(array('done'=>true));
	}
	
    /**
     * @Route("/api/testernombre/{nombre}/{signature}", name="tester_nombre")
     */
	public function testernombre($nombre, $signature)
	{
		$propositon_nombre = $nombre;
		$nombre = filter_var($nombre, FILTER_SANITIZE_NUMBER_INT);
		if(!is_numeric($nombre))
		{
			$retour['result'] = null;
			$retour['proposition'] = $propositon_nombre;
			return new JsonResponse($retour);
		}
		
		$generernombre = $this->container->get('api.generernombre');
		$generernombre->get_nombre();
		
		$session = $this->container->get('session');
		
		$retour = array();
		$nombremystere =  $session->get('nombre_mystere');
		
		$retour['proposition'] = $nombre;
		
		if($nombre < $nombremystere)
		{
			$retour['result'] = false;
			$retour['complement'] = 'supérieur';
		}
		elseif($nombre > $nombremystere)
		{
			$retour['result'] = false;
			$retour['complement'] = 'inferieur';
		}
		else
		{
			$retour['result'] = true;
			$retour['complement'] = 'félicitation';
		}
		
		return new JsonResponse($retour);
	}
}
