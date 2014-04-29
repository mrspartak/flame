<?php

namespace Flame\Config\Adapter;

interface AdapterInterface
{
	public function __construct($mixed);
	public function get();
}