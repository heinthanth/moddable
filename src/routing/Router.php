<?php

namespace Moddable\Framework\Routing;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouteCollection;
use Moddable\Framework\Routing\Route;

class Router
{
	/**
	 * registered routes
	 */
	private RouteCollection $routes;

	public function __construct()
	{
		$this->routes = new RouteCollection();
	}

	/**
	 * add route to collection
	 */
	public function add(Route $route): void
	{
		$this->routes->add($route->name, $route->toSymfony());
	}

	/**
	 * get route collection
	 */
	public function getCollection(): RouteCollection
	{
		return $this->routes;
	}
}
