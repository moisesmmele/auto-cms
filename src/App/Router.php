<?php

namespace Moises\AutoCms\App;

class Router
{
    private array $routes = [];

    public function register(string $uri, callable|array $action): void
    {
        $this->routes[] = [
            $uri => ["action" => $action]
        ];
    }

    public function dispatch($request, $response): void
    {
        $requestUri = $request->getUri();

        foreach ($this->routes as $route) {
            //if requested route matches exactly
            if (array_key_exists($requestUri, $route)) {
                //if action value in routes array is a Closure
                if (is_callable($route[$requestUri]['action'])) {
                    call_user_func($route[$requestUri]['action'], $request, $response);
                    return;
                }
                //if action value in routes array is an array (containing a Controller FQN and an Action Method)
                if (is_array($route[$requestUri]['action'])) {
                    list($controller, $action) = $route[$requestUri]['action'];
                    (new $controller)->$action($request, $response);
                    return;
                }
            }

        }
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
}