<?php

namespace Moddable\Framework\Routing;

use Symfony\Component\Routing\Route as SymfonyRoute;

class Route
{

	/**
	 * name for routes
	 */
	public string $name;

	/**
	 * allow methods
	 */
	private array $methods;

	/**
	 * action to be execute
	 */
	private $action;

	/**
	 * options for route variables
	 */
	private array $options;

	/**
	 * uri to be matched
	 */
	private string $uri;

	/**
	 * Route constructor
	 */
	public function __construct(string $uri, $action)
	{
		$this->uri = $uri;

		$this->name = sha1(time());
		$this->options = [];

		$this->methods = ["GET", "HEAD"];

		// if $action is closure, set it!
		if (is_callable($action)) {
			$this->action = $action;
		} else if (is_string($action)) {
			list($class, $method) = explode("@", $action, 2);
			// controller namespace
			$namespace = "App\\Controller\\";
			// return "App\Controller\{Controller}::method"
			$this->action = "${namespace}${class}::${method}";
		}
	}

	/**
	 * Register options
	 */
	public function where($name, $expression = null): Route
	{
		foreach ($this->parseOption($name, $expression) as $name => $expression) {
			$this->options[$name] = $expression;
		}
		return $this;
	}

	/**
	 * if option is array ($k => $v), return it
	 * else, ($k, $v), create array and return it.
	 */
	private function parseOption($name, $expression): array
	{
		return is_array($name) ? $name : [$name => $expression];
	}

	/**
	 * set name of route
	 */
	public function name(string $name): Route
	{
		$this->name = $name;
		return $this;
	}

	public function toSymfony(): SymfonyRoute
	{
		return new SymfonyRoute(
			$this->uri,
			["_controller" => $this->action],
			$this->options,
			[],
			'',
			[],
			$this->methods
		);
	}

	/**
	 * Add methods
	 */
	public function methods(array $methods): Route
	{
		$this->methods = $methods;
		// if $methods have "GET" but not have "HEAD", add it automatically.
		if (in_array('GET', $this->methods) && !in_array('HEAD', $this->methods)) {
			$this->methods[] = 'HEAD';
		}
		return $this;
	}
}
