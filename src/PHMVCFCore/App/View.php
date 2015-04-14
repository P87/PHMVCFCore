<?php

namespace P87\PHMVCFCore\App;

class View
{
    protected $template;
    protected $source;
    protected $vars;

    public function __construct()
    {
        $this->template = 'template';
    }

    /**
     * Set the master template file
     *
     * @param $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * Assigns a variable to be used in the view
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->vars[$key] = $value;
        return $this;
    }

    /**
     * Generate content for a view (Usually none-template)
     *
     * @param $view
     * @param $data
     * @return string
     */
    public static function view($view, $data)
    {
        extract($data);
        ob_start();
        include( VIEW_DIR . $view . '.php');
        return ob_get_clean();
    }

    /**
     * Draw our view
     *
     * @return bool
     */
    public function render()
    {
        extract($this->vars);
        include(VIEW_DIR . $this->template . '.php');
        return true;
    }
}