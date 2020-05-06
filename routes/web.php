<?php

use Moddable\Framework\Routing\Router;
use Moddable\Framework\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$router = new Router();

$router->add((new Route("/", "PageController@index"))->name("home"));
$router->add(
	(new Route("/var/{id}",  function ($id) {
		return new Response("Hey, you add $id");
	}))->name("variable")->methods(["GET"])->where("id", "[0-9]+")
);
$router->add(
	(new Route("/post", function (Request $request) {
		$id = $request->request->get("id");
		return new Response("Hi, your are #$id");
	}))->name("post")->methods(["POST"])
);

return $router->getCollection();
