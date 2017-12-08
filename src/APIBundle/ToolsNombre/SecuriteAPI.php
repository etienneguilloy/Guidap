<?php
namespace APIBundle\ToolsNombre;
use Symfony\Component\HttpFoundation\Response;

class SecuriteAPI
{
	// Clef pour signature appel api
	protected $key;
	
	public function __construct()
	{
		$this->key = 'abctrouver2445';
	}
	
	public function get_signature($currentUrl)
	{
		$result = hash('sha256',hash('sha256',$currentUrl).$this->key);
		return $result;
	}
	
	public function controleprovenance($referer,$signature)
	{
		$result = hash('sha256',hash('sha256',$referer).$this->key);
		return ($signature==$result);
	}
}