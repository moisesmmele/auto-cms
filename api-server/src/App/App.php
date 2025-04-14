<?php

namespace Moises\AutoCms\App;

use Moises\AutoCms\App\Container\Container;
use Moises\AutoCms\App\Router\Router;

class App
{
    protected static $container;
    protected static $database;
    protected static $router;
    protected static $request;
    protected static $response;

    public static function setContainer(Container $container)
    {
        static::$container = $container;
    }
    public static function container()
    {
        return static::$container;
    }
    public static function setRouter(Router $router)
    {
        static::$router = $router;
    }
    public static function router()
    {
        return static::$router;
    }
    public static function setDatabase($database)
    {
        static::$database = $database;
    }
    public static function database()
    {
        return static::$database;
    }

    public static function setRequest($request)
    {
        static::$request = $request;
    }
    public static function request()
    {
        return static::$request;
    }

    public static function setResponse($response)
    {
        static::$response = $response;
    }
    public static function response()
    {
        return static::$response;
    }
}