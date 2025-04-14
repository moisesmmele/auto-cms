<?php

namespace Moises\AutoCms\App\Router;

use Moises\AutoCms\App\App;

class Router
{
    private array $routes = [];

    // Register method with an additional HTTP method parameter
    public function register(string $method, string $uri, callable|array $action): void
    {
        $this->routes[] = [
            'method' => $method,   // Store HTTP method
            'uri' => $uri,         // Store URI
            'action' => $action    // Store action
        ];
    }

    // Dispatch method to handle the request
    public function dispatch()
    {
        $requestUri = App::request()->getRequestUri();
        $requestMethod = App::request()->getMethod();

        foreach ($this->routes as $route) {
            $pattern = preg_replace("#\{\w+\}#", "([^/]+)", $route['uri']);
            if (preg_match("#^$pattern$#", $requestUri, $matches)) {
                if(isset($matches[1])) {
                    $param = $matches[1];
                } else { $param = null; }
                if ($requestMethod === $route['method']) {
                    $this->callRouteAction($route['action'], $param);
                    return;
                }
            }
        }
        // If no matching route found, return 404
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }

    public function callRouteAction($action, $param)
    {
        // If action is a closure, call it
        if (is_callable($action)) {
            call_user_func($action);
        }
        // If the action is an array (controller and method), call the controller's method
        if (is_array($action)) {
            list($controller, $action) = $action;
            (new $controller)->$action($param);
        }
    }

    public function loadRoutes()
    {
        require_once "routes.php";
    }
}