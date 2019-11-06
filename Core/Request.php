<?php

namespace Core;

class Request
{
    /**
     * if $method exist, return true if $method is the same as $_SERVER["REQUEST_METHOD'],
     * else return $_SERVER["REQUEST_METHOD"]
     *
     * @param string|null $method
     * @return string|bool
     */

    public static function method(string $method = null)
    {
        return isset($method) ? ($method == $_SERVER["REQUEST_METHOD"]) : $_SERVER["REQUEST_METHOD"];
    }


    /**
     * return the Request URL
     * @return string
     */

    public static function url(): string
    {
        return explode("?", $_SERVER["REQUEST_URI"])[0];
    }


    /**
     * return the query string of requests
     * @return array
     */

    public static function query(): array
    {
        if (self::method("GET")) {
            if (isset(explode("?", $_SERVER["REQUEST_URI"])[1])) {
                parse_str(explode("?", $_SERVER["REQUEST_URI"])[1], $tmpQuery);
                return $tmpQuery;
            } else {
                return array();
            }
        } elseif (self::method("POST")) {
            return $_POST;
        }
    }


    /**
     * return query value with key
     * @param string $name
     * @return string
     */
    
    public static function input(string $name)
    {
        $query = self::query();
        return isset($query[$name]) ? $query[$name] : null;
    }
}
