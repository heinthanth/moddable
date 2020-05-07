<?php

namespace App\Controller;

use App\Middleware\Demo;
use Exception;
use Moddable\Framework\Foundation\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{

	public function __construct()
	{
		// do nothing
	}

	public function index(Request $request)
	{
		$str = $this->test();
		return new Response($request->getMethod());
	}

	public function test()
	{
		return "works!";
	}

	public function throw()
	{
		throw new Exception("Just throwing error", 1);
	}
}
