<?php

namespace Core;

use App\Config;
use PDO;

abstract class Model
{
    public static function DB()
    {
        static $db = null;

        if ($db == null) {
            $dsn = 'mysql:host=' . Config::HOST . ';dbname=' . Config::DB . ';charset=utf8';
            $db = new PDO($dsn, Config::USER, Config::PASSWORDS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }
}
