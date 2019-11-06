<?php

namespace Core;

class Router
{
    private static $routes = [];
    private static $matchedRoute = [];

    public static function parseAction($controller)
    {
        return explode('@', $controller);
    }

    public static function get(string $url, string $tmpAction)
    {
        $tmpController = self::parseAction($tmpAction);

        self::$routes["GET"][$url] = [
            "controller" => $tmpController[0],
            "method" => $tmpController[1],
        ];
    }

    public static function post(string $url, string $tmpAction)
    {
        $tmpController = self::parseAction($tmpAction);

        self::$routes["POST"][$url] = [
            "controller" => $tmpController[0],
            "method" => $tmpController[1],
        ];
    }

    public static function match(): bool
    {
        $url = Request::url();
        $method = Request::method();
        $tmpRoute = self::$routes[$method][$url];
        if (isset($tmpRoute)) {
            self::$matchedRoute = [
                "controller" => $tmpRoute["controller"],
                "method" => $tmpRoute["method"],
            ];
            return true;
        } else {
            return false;
        }
    }

    public static function serve(): void {
        if(self::match()) {
            $controller = "App\Controller\\".self::$matchedRoute["controller"];
            $method = self::$matchedRoute["method"];

            $tmpControllerObject = new $controller();
            $tmpControllerObject->$method();
        }
    }

    function list(): array{
        return self::$routes;
    }
}
