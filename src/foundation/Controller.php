<?php

namespace Moddable\Framework\Foundation;

abstract class Controller
{
	/**
	 * Registered middlewares classes to be executed before invoking controller methods
	 */
	private array $middlewares = [];

	/**
	 * Middleware to be registered
	 * 
	 * @param string|array $middlewares
	 */
	protected function middleware($middlewares)
	{
		$this->middlewares = is_array($middlewares) ? $middlewares : [$middlewares];
	}


	/**
	 * Method to get middlewares stacks
	 * 
	 * @return mixed
	 */
	public function getMiddlewares()
	{
		return $this->middlewares;
	}
}
