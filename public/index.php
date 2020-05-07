<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Moddable\Framework\Foundation\Container;
use Symfony\Component\HttpFoundation\Request;

// initialize router
$router = include __DIR__ . "/../routes/web.php";

// load global middlewares
$middlewares = include __DIR__ . "/../config/middleware.php";

// initilize request
$request = Request::createFromGlobals();

// initialize container
$container = new Container($router, $middlewares);

$app = $container->bootstrap();
$app->get("application")->handle($request)->send();
