<?php

namespace Moises\AutoCms\App;

use PDO;

class App
{
    protected static $container;
    protected static $pdo;
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

    public static function setPdo(PDO $pdo)
    {
        static::$pdo = $pdo;
    }

    public static function pdo()
    {
        return static::$pdo;
    }
}