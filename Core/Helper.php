<?php

use eftec\bladeone\BladeOne;

function env(string $name, $default = null)
{
    if (file_exists(__DIR__ . "/../env.php")) {
        require_once __DIR__ . "/../env.php";
        if (array_key_exists($name, $config)) {
            return $config[$name];
        } else {
            return $default;
        }
    } else {
        return $default;
    }
}

function view(string $bladefile, array $var = []): void {
    $views = __DIR__.'/../Resource/View';
    $cache = __DIR__.'/../Resource/cache';
    $blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
    echo $blade->run($bladefile, $var);
}