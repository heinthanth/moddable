<?php

use Symfony\Component\HttpFoundation\Response;
use Moddable\Framework\Routing\Router;

$router = new Router();

$router->get("/", "PageController@index", "home");
$router->get("/closure", function () {
	return new Response("works with closures!");
}, "closure");

return $router;
