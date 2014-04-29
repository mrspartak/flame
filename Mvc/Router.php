<?php

namespace Flame\Mvc;

class Router
{
	private $_path = '';
	private $_controller = 'index';
	private $_action = 'index';

	public function __construct() {}

	public function run()
	{
		$this->getRewriteUrl();
		$this->matchRoute();
	}

	public function getRewriteUrl()
	{
		$request = \Flame\Di::getInstance()->request;
		$url = \Flame\Di::getInstance()->url;
		$this->_path = $url->resolvePath();
	}

	public function matchRoute()
	{
		$path = explode('/', $this->_path);
		if($path[0]) $this->_controller = $path[0];
		if($path[1]) $this->_action = $path[1];
	}

	public function getController()
	{
		return $this->_controller;
	}

	public function getAction()
	{
		return $this->_action;
	}
}