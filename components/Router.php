<?php

/**
 * Class Router
 */

class Router
{
    /**
     * @var array 
     */
    private $routes;

    public function __construct()
    {
        // Path to route file
        $routesPath = ROOT . '/config/routes.php';

        // getting routes from file
        $this->routes = include($routesPath);
    }

    /**
     * return request string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * Method for frocessing request
     */
    public function run()
    {
        // get URI
        $uri = $this->getURI();

        // Check match in routs (routes.php)
        foreach ($this->routes as $uriPattern => $path) {

            // Compare $uriPattern and $uri
            if (preg_match("~$uriPattern~", $uri)) {

                // Get inner path from outer by r.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // Define controller, action, params
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                // include file
                $controllerFile = ROOT . '/controllers/' .
                        $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Create object
                $controllerObject = new $controllerName;

                /* Call need action ($actionName) from ($controllerObject) 
                 * with ($parameters)
                 */
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                // If controller's method was call, stop router work
                if ($result != null) {
                    break;
                }
            }
        }
    }
}
