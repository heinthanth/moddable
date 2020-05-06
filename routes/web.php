<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use App\Controller\PageController;
use Symfony\Component\HttpFoundation\Response;

return function (RoutingConfigurator $routes) {
	$routes->add("home", "/")->controller([PageController::class, 'index']);

	$routes->add("closure", "/closure")->controller(function () {
		return new Response("Works with closure!");
	});

	$routes->add("error", "/throw")->controller([PageController::class, "throw"]);
};
