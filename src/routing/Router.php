<?php

namespace Moddable\Framework\Routing;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

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
	 * register as GET
	 */
	public function get(string $uri, $action, string $name = "")
	{
		if (is_string($action)) {
			$this->RegisterWithString($uri, $action, $name);
		} else if (is_callable($action)) {
			$this->RegisterWithCallback($uri, $action, $name);
		}
	}

	private function RegisterWithString(string $uri, string $action, string $name)
	{
		list($class, $method) = explode("@", $action, 2);
		$this->routes->add($name, new Route($uri, ["_controller" => "App\\Controller\\$class::$method"]));
	}

	private function RegisterWithCallback(string $uri, callable $action, string $name)
	{
		$this->routes->add($name, new Route($uri, ["_controller" => $action]));
	}

	public function generate()
	{
		return $this->routes;
	}
}
