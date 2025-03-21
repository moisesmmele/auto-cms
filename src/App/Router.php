<?php

namespace Moises\AutoCms\App;

use Moises\AutoCms\App\Http\Request;
use Moises\AutoCms\App\Http\Response;

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
    public function dispatch(Request $request, Response $response): void
    {
        $requestUri = $request->getUri();
        $requestMethod = $request->getMethod(); // Get the HTTP method from the request

        foreach ($this->routes as $route) {
            // Check if the method and URI match
            if ($requestMethod === $route['method'] && $requestUri === $route['uri']) {
                // If the action is a Closure, call it
                if (is_callable($route['action'])) {
                    call_user_func($route['action'], $request, $response);
                    return;
                }

                // If the action is an array (controller and method), call the controller's method
                if (is_array($route['action'])) {
                    list($controller, $action) = $route['action'];
                    (new $controller)->$action($request, $response);
                    return;
                }
            }
        }

        // If no matching route found, return 404
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
}
