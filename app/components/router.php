<?php

class Router
{
    /**
     * @var mixed
     * contains dependencies 'URI'=> 'class/method' as the array
     */
    private $routes;

    public function __construct()
	{
		$this->routes = require_once(ROOT.'/config/routes.php');
	}

    /**
     * Parse URI and choose the certain method and class to pass request
     * if the URI was not found in routes array returns 404 server error
     */
    public function chooseRoute() {
		$path = $_SERVER['REQUEST_URI'];
		foreach ($this->routes as $rt => $pth) {
			if (preg_match($rt, $path)) {
				$result = explode('/', $pth);
				$className = ucfirst(array_shift($result));
				$actionName = 'action'.ucfirst(array_shift($result));
                $classPath = ROOT.'/controllers/'.$className.'.php';
                if (file_exists($classPath)) {
                    require_once($classPath);
                }
                $controllerObject = new $className;
                $controllerObject->$actionName();
				break;
			}
		}
		if (!isset($className)) {
            header('HTTP/1.0 404 Not Found', true, 404);
            die();
        }
	}
}
