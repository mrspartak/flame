<?php

namespace Flame\Http;

class Request 
{
	private $_method;
	private $_scheme;
	private $_host;
	private $_path;
	private $_query;

	public function __construct()
	{
		$this->_method = $_SERVER['REQUEST_METHOD'];
		$this->_scheme = $_SERVER['HTTPS'] ? 'https' : 'http';
		$this->_host = $_SERVER['HTTP_HOST'];
		$this->_path = $_SERVER['PATH_INFO'];
		$this->_query = $_SERVER['QUERY_STRING'];
	}

	public function get($param)
	{
		return $_GET[$param];
	}

	public function getPost($param)
	{
		return $_POST[$param];
	}

	public function isGet()
	{
		return $this->_method == 'GET';
	}

	public function isPost()
	{
		return $this->_method == 'POST';
	}

	public function getHost()
	{
		return $this->_host;
	}

	public function getPath()
	{
		return $this->_path;
	}

	public function getScheme()
	{
		return $this->_scheme;
	}
}