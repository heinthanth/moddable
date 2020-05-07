<?php

namespace App\Middleware;

use Moddable\Framework\Http\Middleware;
use Symfony\Component\HttpFoundation\Request;

class Demo extends Middleware
{
	public function handle(Request $request)
	{
		echo "From Demo middleware : change method to POST";
		$request->setMethod("POST");
		echo "<br><br>";
	}
}
