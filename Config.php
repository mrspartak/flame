<?php

namespace Flame;

class Config implements \ArrayAccess
{
	protected $container;

	public function __construct($mixed)
	{
		if(is_array($mixed)) {
			$this->container = $mixed;
		} elseif(is_string($mixed)) {
			if(is_readable($mixed)) {
				$extension = pathinfo($mixed, PATHINFO_EXTENSION);
				switch($extension) {
					case 'ini':
						$adapter = new Config\Adapter\Ini($mixed);
						$this->container = $adapter->get();
					break;

					case 'json':
						$adapter = new Config\Adapter\Json($mixed);
						$this->container = $adapter->get();
					break;

					case 'php':
						$adapter = new Config\Adapter\Php($mixed);
						$this->container = $adapter->get();
					break;

					default:
					throw new Config\Exception('unknown format extension');
				}
			} else {
				$adapter = new Config\Adapter\Json($mixed);
				$this->container = $adapter->get();
			}
		}
	}

	public function offsetSet($offset, $value)
	{
		if (is_null($offset)) {
			$this->container[] = $value;
		} else {
			$this->container[$offset] = $value;
		}
    }

	public function offsetExists($offset)
	{
		return isset($this->container[$offset]);
	}

	public function offsetUnset($offset)
	{
		unset($this->container[$offset]);
	}

	public function offsetGet($offset)
	{
		return isset($this->container[$offset]) ? $this->container[$offset] : null;
	}

	public function __get($offset)
	{
		$container = self::convert($this->container);
		return $container->$offset;
	}

	public function __set($offset, $value)
	{
		$container = self::convert($this->container);
		$container->$offset = $value;
	}

	private static function convert($array)
	{
		$object = new \stdClass();
		if(is_array($array))
		{
			foreach ($array as $key => $value) {
				if(is_array($value))
					$object->$key = self::convert($value);
				else
					$object->$key = $value;
			}
		}

		return $object;
	}
}