<?php

namespace Moises\AutoCms\App\Router;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Middleware\AuthMiddleware;

class RouterOld
{
    private array $routes = [];

    // Register method with an additional HTTP method parameter
    public function register(string $method, string $uri, callable|array $action): self
    {
        $this->routes[] = [
            'method' => $method,   // Store HTTP method
            'uri' => $uri,         // Store URI
            'action' => $action,   // Store action
            'middleware' => null,
        ];
        return $this;
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
                    $this->checkMiddleware($route, function ($route, $param) {
                        $this->callRouteAction($route['action'], $param);
                    });
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

    public function checkMiddleware($route, $action)
    {
        if (isset($route['middleware'])) {
            (new $route['middleware'])->handle($action);
        }
        return $action;
    }

    public function middleware(string $middleware)
    {
        $lastIndex = array_key_last($this->routes);
        if ($lastIndex !== null) {
            $this->routes[$lastIndex]['middleware'] = $middleware;
        }
    }
}