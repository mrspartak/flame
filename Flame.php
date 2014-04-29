<?php
/**
 * Flame bootstrap file
 */

class Flame
{
	private $_directories = array();

	public function __construct()
	{
	}

	public function registerDirs(array $dirs)
	{
		$this->_directories = array_merge($dirs, $this->_directories);
	}

	public function autoload($className)
	{
		$this->checkFlame($className);
		$this->checkDirs($className);
	}

	public function loaderRegister()
	{
		spl_autoload_register(array('Flame', 'autoload'));
	}

	private function checkFlame($className)
	{
		$namespace = explode('\\', $className);
		array_shift($namespace);

		$classPath = __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $namespace) . '.php';
		if(is_readable($classPath)) {
			require_once $classPath;
		}
	}

	private function checkDirs($className)
	{
		$classPath = $className . '.php';
		foreach($this->_directories as $directory) {
			$path = $directory . DIRECTORY_SEPARATOR . $classPath;
			if(is_readable($path)) {
				require_once $path;
			}
		}
	}
}

