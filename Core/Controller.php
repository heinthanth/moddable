<?php

namespace Core;

abstract class Controller
{
    public function __call($name, $arguments)
    {
        $method = $name;
        if (method_exists($this, $method)) {
            call_user_func_array([$this, $method], $arguments);
        }
    }
}
