<?php

namespace P87\PHMVCFCore\App;

class Route
{
    protected $routes;

    public function __construct()
    {
        $this->routes = array();
    }

    /**
     * Creates a route for the framework to "listen" for
     *
     * @param $uri
     * @param $data
     * @return $this
     */
    public function set($uri, $data)
    {
        $data['data'] = array();
        $this->routes[$uri] = $data;

        return $this;
    }

    /**
     * Decide which route they are trying to access
     *
     * @param $route
     * @return mixed
     */
    public function decide($route)
    {
        if ( array_key_exists($route, $this->routes) ) {
            return $this->routes[$route];
        }

        foreach ( array_keys($this->routes) as $r ) {
            // convert our key into regex
            $search = '/' . str_replace(['<', '>', '/'], ['(?\'', '\'[0-9a-z\-]*)', '\/'], $r) . '$/';

            if ( preg_match($search, $route, $matches) ) {
                $this->routes[$r]['data'] = $this->arrangeVars($matches);
                return $this->routes[$r];
            }
        }

        return false;
    }

    /**
     * Get all the routes that have been set
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Get the variables out of the route
     *
     * @param $route
     * @return arrray
     */
    private function extractVars($route)
    {
        $vars = array();
        if ( preg_match('/<([a-z\-]*)>/', $route, $matches) ) {
            $vars[] = $matches;
        }

        return $vars;
    }

    /**
     * Removes keys we don't need from our array
     *
     * @param $matches
     * @return mixed
     */
    private function arrangeVars($matches)
    {
        foreach (array_keys($matches) as $key ) {
            if ( is_numeric($key) ) {
                unset($matches[$key]);
            }
        }

        return $matches;
    }
}