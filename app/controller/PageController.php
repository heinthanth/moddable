<?php

namespace App\Controller;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class PageController
{
	public function index()
	{
		return new Response("It works!");
	}

	public function throw()
	{
		throw new Exception("Just throwing error", 1);
	}
}
