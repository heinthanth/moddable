<?php

namespace App\Middleware;

use Moddable\Framework\Http\Middleware;
use Symfony\Component\HttpFoundation\Request;

class Two extends Middleware
{
	public function handle(Request $request)
	{
		echo "from middleware two : Request method => ";
		echo $request->getMethod();
		echo "<br><br>";
	}
}
