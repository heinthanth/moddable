<?php

use App\Middleware\Demo;
use App\Middleware\Two;

/**
 * Global middlewares to be executed on Request to application
 */
return [
	Demo::class,
	Two::class
];
