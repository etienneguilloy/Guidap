<?php

namespace APIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/api/testernombre/{nombre}", name="tester_nombre")
     */
	public function testernombre($nombre)
	{
		/*$lenombre = $this->container->get('api.lenombre');
		// return $this->json(array('nombre' => $nombre));
		$myresponse = array(
			'lenombre' => $lenombre->get_nombre()
		);*/
		$retour = array();
		$nombremystere = 50;
		
		$message = 'Votre proposition '.$nombre;
		
		if($nombre < $nombremystere)
		{
			$retour['result'] = false;
			$retour['message'] = $message.' - Le nombre mystère est supérieur';
		}
		elseif($nombre > $nombremystere)
		{
			$retour['result'] = false;
			$retour['message'] = $message.' - Le nombre mystère est inferieur';
		}
		else
		{
			$retour['result'] = true;
			$retour['message'] = $message.' - Vous avez trouvé le nombre';
		}
		return new JsonResponse($retour);
	}
}
