<?php

use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Container;
use Moises\AutoCms\App\Http\Request;
use Moises\AutoCms\App\Http\Response;
use Moises\AutoCms\App\Router;

require_once dirname(__DIR__) . '/vendor/autoload.php';
$dsn = 'sqlite:' . dirname(__DIR__) . '/db.sqlite';

App::setContainer(new Container());
App::setPdo(new PDO(dsn: $dsn));
App::setRouter(new Router());

App::container()->set(\Moises\AutoCms\Core\Repositories\Vehicle\MakeRepository::class, \Moises\AutoCms\App\Repositories\Pdo\PdoMakeRepository::class);

App::router()->register('GET', '/test', [\Moises\AutoCms\App\Controllers\TestController::class, 'index']);
App::router()->register('GET', '/makes', [\Moises\AutoCms\App\Controllers\Vehicle\MakeController::class, 'index']);
App::router()->register('POST', '/makes', [\Moises\AutoCms\App\Controllers\Vehicle\MakeController::class, 'create']);

$request = new Request();
$response = new Response();

App::router()->dispatch($request, $response);