<?php

namespace Flame\Mvc;

class Url 
{
	private $_baseUri = '/';
	private $_path;

	public function __construct() {
		
	}

	public function setBaseUri(string $uri)
	{
		$this->_baseUri = $uri;
	}

	public function getBaseUri()
	{
		return $this->_baseUri;
	}

	public function resolvePath()
	{
		$request = \Flame\Di::getInstance()->request;
		$path = $request->get('_url');
		if(!$path) {
			$path = $request->getPath();
			$_baseUri = preg_quote($this->_baseUri, '/');
			$path = preg_replace( "/^". $_baseUri ."/i", '', $path);
		}

		return $path;
	}
}