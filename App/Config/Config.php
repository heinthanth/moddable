<?php

namespace App;

class Config {

    const HOST = env('HOST', 'localhost');
    const USER = env('USERNAME', 'root');
    const PASSWORDS = env('PASSWORD', 'passwords');
    const DB = env('DB');
    const DEBUG = env('DEBUG', false);
    
}