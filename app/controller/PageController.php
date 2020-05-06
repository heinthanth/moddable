<?php

namespace App\Controller;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class PageController
{
	public function index()
	{
		$str = $this->test();
		return new Response("It $str");
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
