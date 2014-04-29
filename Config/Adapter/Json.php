<?php

namespace Flame\Config\Adapter;

use Flame\Config;
use Flame\Config\Adapter;

class Json implements AdapterInterface 
{
	private $container;
	
	public function __construct($mixed)
	{
		if(is_readable($mixed)) {
			$content = file_get_contents($mixed);
		} else {
			$content = $mixed;
		}

		$this->container = json_decode($content, true);
	}

	public function get()
	{
		return $this->container;
	}
}