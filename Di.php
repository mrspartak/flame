<?php

namespace Flame;

class Di
{
	private $container;
	private static $instance;

	public function __construct()
	{
		self::setInstance($this);
	}

	public static function getInstance()
	{
		return self::$instance;
	}

	public static function setInstance($instance)
	{
		self::$instance = $instance;
	}

	public function set($serviceName, $callback, $shared = false)
	{
		$this->container[$serviceName] = new Di\Service($serviceName, $callback, $shared);
	}

	public function setShared($serviceName, $callback)
	{
		$this->set($serviceName, $callback, true);
	}

	public function get($serviceName)
	{
		return $this->container[$serviceName];
	}

	public function __get($serviceName)
	{
		return $this->container[$serviceName];
	}
}