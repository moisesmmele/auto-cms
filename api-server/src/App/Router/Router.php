<?php

namespace Moises\AutoCms\App\Router;

use Moises\AutoCms\App\App;

class Router
{
    private array $routes = [];

    /**
     * Register a route with method, URI pattern, action, and optional middleware.
     */
    public function register(string $method, string $uri, callable|array $action): self
    {
        $paramNames = [];

        // Build regex pattern and capture parameter names
        $pattern = preg_replace_callback('#\{(\w+)\}#', function ($matches) use (&$paramNames) {
            $paramNames[] = $matches[1];
            return '([^/]+)';
        }, $uri);
        $pattern = "#^{$pattern}$#";

        $this->routes[] = [
            'method'     => strtoupper($method),
            'uri'        => $uri,
            'action'     => $action,
            'middleware' => [],
            'pattern'    => $pattern,
            'paramNames' => $paramNames,
        ];

        return $this;
    }

    /**
     * Attach middleware to the most recently registered route.
     */
    public function middleware(string $middleware): self
    {
        $lastIndex = array_key_last($this->routes);
        if ($lastIndex !== null) {
            $this->routes[$lastIndex]['middleware'][] = $middleware;
        }
        return $this;
    }

    /**
     * Load routes definitions from routes.php
     */
    public function loadRoutes(): void
    {
        require_once DIR . '/src/App/Router/routes.php';
    }

    /**
     * Dispatch the current request to the matching route.
     */
    public function dispatch(): void
    {
        $requestUri    = App::request()->getRequestUri();
        $requestMethod = App::request()->getMethod();

        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod) {
                continue;
            }

            if (preg_match($route['pattern'], $requestUri, $matches)) {
                array_shift($matches); // remove full match
                $params = [];
                foreach ($route['paramNames'] as $i => $name) {
                    $params[$name] = $matches[$i] ?? null;
                }

                $this->handleMiddleware($route, $params);
                return;
            }
        }

        // No route matched: 404
        header("HTTP/1.1 404 Not Found");
        echo "404 Not Found";
    }

    /**
     * Execute middleware stack and finally the route action.
     */
    protected function handleMiddleware(array $route, array $params): void
    {
        // Build initial action callable
        $action = function () use ($route, $params) {
            $this->executeAction($route['action'], $params);
        };

        // Wrap middleware in reverse order
        foreach (array_reverse($route['middleware']) as $middlewareClass) {
            $next = $action;
            $action = function () use ($middlewareClass, $next) {
                (new $middlewareClass())->handle($next);
            };
        }

        // Execute the stack
        $action();
    }

    /**
     * Call the route action (closure or controller method) with parameters.
     */
    protected function executeAction(callable|array $action, array $params): void
    {
        if (is_callable($action) && !is_array($action)) {
            call_user_func_array($action, $params);
            return;
        }

        if (is_array($action) && count($action) === 2) {
            [$controller, $method] = $action;
            (new $controller())->$method(...array_values($params));
            return;
        }

        throw new \RuntimeException('Invalid route action specified.');
    }
}
