<?php

namespace Flame\Config\Adapter;

use Flame\Config;
use Flame\Config\Adapter;

class Ini implements AdapterInterface 
{
	private $container;
	
	public function __construct($mixed)
	{
		$this->container = parse_ini_file($mixed, true);
	}

	public function get()
	{
		return $this->container;
	}
}