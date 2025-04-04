<?php

use Dotenv\Dotenv;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Container\Container;
use Moises\AutoCms\App\Database\Database;
use Moises\AutoCms\App\Router\Router;

#use Moises\AutoCms\App\Http\Request;
#use Moises\AutoCms\App\Http\Response;

require_once dirname(__DIR__) . '/vendor/autoload.php';

Dotenv::createImmutable(dirname(__DIR__), '.env')->load();

App::setContainer(new Container());
App::container()->loadBindings();

App::setDatabase(new Database());

App::setRouter(new Router());
App::router()->loadRoutes();

App::setRequest(Request::createFromGlobals());
App::setResponse(new Response());

App::router()->dispatch();