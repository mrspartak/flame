<?php

namespace Flame\Mvc;

class Controller
{
	
	public function render($action = __METHOD__, $params = null)
	{
		$callers = debug_backtrace();
		$class = $callers[1]['class'];
		$action = $callers[1]['function'];

		$class = str_replace('Controller', '', $class);
		$action = str_replace('Action', '', $action);

		$view = \Flame\Di::getInstance()->view;
		$view->render($class, $action, $params);
	}
}