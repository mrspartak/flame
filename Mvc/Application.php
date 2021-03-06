<?php

namespace Flame\Mvc;

class Application
{

	public function __construct($di)
	{
		
	}

	public function run()
	{
		$dispatcher = \Flame\Di::getInstance()->dispatcher;
		$dispatcher->dispatch();

		$view = \Flame\Di::getInstance()->view;
		return $view->getRendered();
	}
}