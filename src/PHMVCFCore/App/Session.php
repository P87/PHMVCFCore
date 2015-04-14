<?php

namespace P87\PHMVCFCore\App;

class Session
{
    /**
     * Attach a variable to our session
     *
     * @param string $name 
     */
    public static function set($name, $value)
    {
    	$_SESSION[$name] = $value;
    }
    
    /**
     * Get a variable from our session
     *
     * @param string $name 
     */
    public static function get($name)
    {
    	return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
    }
    
    /**
     * Delete the variable from our session
     *
     * @param string $name
     */
    public static function delete($name)
    {
    	unset($_SESSION[$name]);
    }
    
    /**
     * Returns the csrf_token, or creates a new one if needed
     *
     * @return string
     */
    public static function csrf_token()
    {
    	if ( isset($_SESSION['csrf_token']) ) {
        	return $_SESSION['csrf_token'];
        }
        $_SESSION['csrf_token'] = md5(uniqid(rand(), true));
        return $_SESSION['csrf_token'];
    }    
}
