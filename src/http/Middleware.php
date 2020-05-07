<?php

namespace Moddable\Framework\Http;

use Symfony\Component\HttpFoundation\Request;

abstract class Middleware
{
	/**
	 * Handle request
	 */
	public function handle(Request $request)
	{
		// code to handle middlewares
	}
}
