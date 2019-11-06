<?php

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
