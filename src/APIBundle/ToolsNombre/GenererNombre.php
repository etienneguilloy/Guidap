<?php
namespace APIBundle\ToolsNombre;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class GenererNombre
{
	private $session;
	private $container;
	
	public function __construct($container)
	{
		$this->container = $container;
		$this->session = $this->container->get('session');
	}
	
	public function get_nombre()
	{
		$this->session = $this->container->get('session');
		$this->init_nombre();
		return $this->session->get('nombre_mystere');
	}
	
	public function nouveau_nombre()
	{
		$this->session = $this->container->get('session');
		$this->generer_nombre();
	}
	
	private function init_nombre()
	{
		$this->session = $this->container->get('session');
		if(!$this->session->get('nombre_mystere'))
		{
			$this->generer_nombre();
		}
	
	}
	
	private function generer_nombre()
	{
		$this->session->set('nombre_mystere',rand(0,100));
	}
}