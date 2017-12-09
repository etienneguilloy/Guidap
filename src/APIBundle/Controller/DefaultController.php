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
		return new JsonResponse(array('done'=>true, 'type'=>'alert-success', 'msg'=>'Nouveau nombre généré'));
	}
	
    /**
     * @Route("/api/testernombre/{nombre}/{signature}", name="tester_nombre")
     */
	public function testernombre($nombre, $signature)
	{
		$nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
		if(!is_numeric($nombre) || (is_numeric($nombre) && ($nombre< 0 ||$nombre > 100)) || (is_numeric($nombre) && intval($nombre) != $nombre))
		{
			$retour['result'] = null;
			$retour['msg'] = 'Votre proposition doit être un entier entre 0 et 100';
			$retour['type'] = 'alert-warning';
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
			$retour['complement'] = 'Félicitation vous avez trouvé le nombre mystère';
			$retour['type'] = 'alert-success';
		}
		
		return new JsonResponse($retour);
	}
}
