<?php

namespace Flame\Config\Adapter;

use Flame\Config;
use Flame\Config\Adapter;

class Php implements AdapterInterface 
{
	private $container;
	
	public function __construct($mixed)
	{
		$this->container = include($mixed);
	}

	public function get()
	{
		return $this->container;
	}
}