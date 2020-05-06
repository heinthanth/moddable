<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Moddable\Framework\Foundation\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\PhpFileLoader;

// load routes
$fileLocator = new FileLocator([__DIR__ . "/../routes"]);
$loader = new PhpFileLoader($fileLocator);
$routes = $loader->load("web.php");

// initilize request
$request = Request::createFromGlobals();

// initialize container
$container = new Container($routes);

$app = $container->bootstrap();

$app->get("application")->handle($request)->send();
