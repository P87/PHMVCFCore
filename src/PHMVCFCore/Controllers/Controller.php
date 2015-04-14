<?php

namespace P87\PHMVCFCore\Controllers;

class Controller
{
    protected $route;

    public function __construct($route)
    {
        $this->route = $route;
    }
}