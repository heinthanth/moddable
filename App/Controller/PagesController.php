<?php

namespace App\Controller;

use Core\Controller;
use eftec\bladeone\BladeOne;

class PagesController extends Controller
{
    public function index()
    {
        return view("hello", ["engine" => "Blade Engine"]);
    }
}
