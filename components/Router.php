<?php

class Router
{

	private static $routes = [];
	private static $method;

	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		include($routesPath);
	}

// Return type

	public static function get($path) {
		self::$routes[$path[0]] = $path[1];
		self::$method = 'GET';
	}

	public static function post($path) {
		self::$routes[$path[0]] = $path[1];
		self::$method = 'POST';
	}

	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run()
	{
		$url = $this->getURI();
		if($url == '') {
			$url = '/';
		}
		foreach (self::$routes as $urlPattern => $path) {

			if(preg_match("~$urlPattern~", $url)) {

				$internalRoute = preg_replace("~$urlPattern~", $path, $url);

				$segments = explode('/', $internalRoute);

				
				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);


				$actionName = array_shift($segments);

				$parameters = $segments;


				$controllerFile = ROOT . '/controllers/' .$controllerName. '.php';
				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				}

				$controllerObject = new $controllerName;
				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
				
				if ($result != null) {
					break;
				}
			}

		}
	}
}