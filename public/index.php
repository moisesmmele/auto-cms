<?php

use Dotenv\Dotenv;
use Moises\AutoCms\App\App;
use Moises\AutoCms\App\Container;
use Moises\AutoCms\App\Controllers\TestController;
use Moises\AutoCms\App\Controllers\Vehicle\ColorsController;
use Moises\AutoCms\App\Controllers\Vehicle\MakeController;
use Moises\AutoCms\App\Database\Database;
use Moises\AutoCms\App\Http\Request;
use Moises\AutoCms\App\Http\Response;
use Moises\AutoCms\App\Repositories\Pdo\FakeColorsRepository;
use Moises\AutoCms\App\Repositories\Pdo\PdoMakeRepository;
use Moises\AutoCms\App\Router;
use Moises\AutoCms\Core\Repositories\Vehicle\ColorsRepository;
use Moises\AutoCms\Core\Repositories\Vehicle\MakeRepository;

require_once dirname(__DIR__) . '/vendor/autoload.php';
Dotenv::createImmutable(dirname(__DIR__), '.env')->load();

App::setContainer(new Container());
App::setDatabase(new Database());
App::setRouter(new Router());
App::setRequest(new Request());
App::setResponse(new Response());

App::container()->set(MakeRepository::class, PdoMakeRepository::class);
App::container()->set(ColorsRepository::class, FakeColorsRepository::class);

App::router()->register('GET', '/test', [TestController::class, 'index']);
App::router()->register('GET', '/makes', [MakeController::class, 'index']);
App::router()->register('POST', '/makes', [MakeController::class, 'store']);
App::router()->register('GET', '/colors', [ColorsController::class, 'index']);
App::router()->register('POST', '/colors', [ColorsController::class, 'create']);
App::router()->register('GET', '/colors/{id}', [ColorsController::class, 'show']);
App::router()->register('GET', '/testing', [TestController::class, 'testing']);
App::router()->register('POST', '/testing', [TestController::class, 'testing']);


App::router()->dispatch();