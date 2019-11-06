<?php

use Core\Router;

require __DIR__.'/vendor/autoload.php';

include __DIR__.'/routes.php';

Router::serve();