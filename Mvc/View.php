<?php

namespace Flame\Mvc;

class View 
{
	private $_viewDir = '';
	private $_mainLayout = 'main.php';

	private $_actionContent = '';
	private $_mainContent = '';

	public function __construct() {
		
	}

	public function setViewDir($path)
	{
		$this->_viewDir = $path;
	}

	public function render($controller, $action, $params)
	{
		$mainLayout = $this->_viewDir . DIRECTORY_SEPARATOR . $this->_mainLayout;
		$actionLayout = $this->_viewDir . DIRECTORY_SEPARATOR . strtolower($controller) . DIRECTORY_SEPARATOR . strtolower($action) . '.php';
		
		$this->_actionContent = $this->renderFile($actionLayout, $params);
		$this->_mainContent = $this->renderFile($mainLayout, $params);
	}

	public function getContent()
	{
		return $this->_actionContent;
	}

	public function getRendered()
	{
		return $this->_mainContent;
	}

	public function renderFile($file, $params)
	{
		if (is_array($vars) && !empty($vars)) {
        	extract($vars);
   		}
    	ob_start();
   		include $file;
    	return ob_get_clean();
	}
}