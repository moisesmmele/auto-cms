<?php

namespace Moises\AutoCms\App;

use PDO;

class App
{
    protected static $container;
    protected static $database;
    protected static $router;

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
        static::$pdo = $database;
    }

    public static function database()
    {
        return static::$database;
    }
}