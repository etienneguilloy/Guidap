<?php
namespace APIBundle\Secure;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class SecuriteAPIListener
{
	protected $securiteAPI;
	
	public function __construct(SecuriteAPI $securiteAPI)
	{
		$this->securiteAPI = $securiteAPI;
	}
	
	public function processSecure(FilterResponseEvent $event)
	{
		$ref = $event->getRequest()->headers->get('referer');
		$response = $this->securiteAPI->controleprovenance($ref,'');
		// $event->setResponse($response);
		// return $response;
	}
}