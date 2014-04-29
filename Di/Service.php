<?php

namespace Flame\Di;

class Service
{
	private $serviceName;
	private $callback;
	private $shared;

	private $service;

	public function __construct($serviceName, $callback, $shared)
	{
		$this->serviceName = $serviceName;
		$this->callback = $callback;
		$this->shared = $shared;
	}

	public function __call($method, $arguments)
	{
		if(empty($this->service)) {
			$callback = $this->callback;
			if(is_callable($callback)) {
				$service = $callback();
			} else {
				$service = new $callback();
			}
			
			if($this->shared)
				$this->service = $service;
		} else
			$service = $this->service;

		return call_user_func_array(array($service, $method), $arguments);
	}
}