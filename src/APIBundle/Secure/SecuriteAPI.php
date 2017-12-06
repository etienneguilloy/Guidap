<?php
namespace APIBundle\Secure;
use Symfony\Component\HttpFoundation\Response;

class SecuriteAPI
{
	private $key;
	
	public function __construct()
	{
		$this->key = 'abctrouver2445';
	}
	
	public function controleprovenance($referer,$signature)
	{
		$result = hash('sha256',hash('sha256',$referer).$this->key);
		
		// return ($signature==$result);
		echo ($signature==$result) ? 'vrai' : 'faux';
	}
}