<?php

namespace Flame\Mvc;

class Dispatcher
{
	private $_controller;
	private $_action;

	public function __construct() {
		$router = \Flame\Di::getInstance()->router;
		$this->setController($router->getController());
		$this->setAction($router->getAction());
	}

	public function dispatch()
	{
		$controller = ucfirst($this->_controller) . 'Controller';
		$action = ucfirst($this->_action) . 'Action';

		$unit = new $controller();
		$unit->$action();
	}

	public function setController($controller)
	{
		return $this->_controller = $controller;
	}

	public function getController()
	{
		return $this->_controller;
	}

	public function setAction($action)
	{
		return $this->_action = $action;
	}

	public function getAction()
	{
		return $this->_action;
	}
}