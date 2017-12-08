<?php
namespace APIBundle\ToolsNombre;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class SecuriteAPIListener
{
	protected $securiteAPI;
	
	public function __construct(SecuriteAPI $securiteAPI)
	{
		$this->securiteAPI = $securiteAPI;
	}
	
	// Recuperation du referer pour controle de la signature
	public function processSecure(FilterControllerEvent $event)
	{
		$controller = $event->getController();
		if ($controller[0] instanceof \APIBundle\Controller\DefaultController) {
			
			$request = $event->getRequest();
			$signature = $request->attributes->get('signature');
			$referer = $request->headers->get('referer');
			$signOK = $this->securiteAPI->controleprovenance($referer,$signature);
			
			if(!$signOK)
			{
				die(new Response("Acces interdit depuis cette page", 403));
			}
			
			
		}
		
	}
}