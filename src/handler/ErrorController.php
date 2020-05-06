<?php

namespace Moddable\Framework\Handler;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\ErrorHandler\Exception\FlattenException;

class ErrorController
{
	public function exception(FlattenException $exception)
	{
		$msg = 'Something went wrong! (' . $exception->getMessage() . ')';
		return new Response($msg, $exception->getStatusCode());
	}
}
