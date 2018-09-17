<?php

class EasyView
{
    private $vw = array();
    private $ly = array();
    private $root;
    private $name; 
    private $view;
    private $filename;
    private $extends;
    private $log = array();

    /**
     * Creates a new EasyView template
     * 
     * @param string $route Route to the views folder from where class its call.
     */
    public function __construct($route, $extend_name)
    {
        if( !file_exists( $route ) OR !is_dir( $route ) )
        { $this->log['directory_missing'] = "The root directory for view <{$route}> files is not valid."; }

        $this->extends = $extend_name; 
        $this->root = $route; 
    }

    public function ly($name)
    {
        echo $this->get_value($name, true);
    }

    public function vw($name, $index = null, $default = null)
    {
        if( $index === null )
        { 
            $value = $this->get_value($name); 
        }else{
            $value = $this->get_value($name)[$index];
        }

        if( $value == null OR $value == '' )
        { echo $default; }

        echo $value;
    }

    public function css( $name = null, $version = null )
    {
        if(!$name)
        { $name = $this->name; }
        if(!$version)
        { $version = rand(0, 9999); }

        $http = HTTP;

        echo "<link rel='stylesheet' href='{$http}/{$this->root}{$name}.css?v={$version}'>"; 
    }

    public function url($extend)
    {
        echo HTTP . "/$extend"; 
    }

    public function vendor($format, $directory, $version = null)
    {
        if(!$version)
        { $version = rand(0, 9999); }
        
        $http = HTTP;

        switch ($format) {
            case 'css':
                echo "<link rel='stylesheet' href='{$http}/views/vendors/{$directory}.css?v={$version}'>"; 
                break;

            case 'js':
                echo "<script src='{$http}/views/vendors/{$directory}.js?v={$version}'></script>";
                break;

            case 'ico/png':
                echo "<link rel='icon' type='image/png' href='{$http}/views/vendors/{$directory}.png' />";
                break;
                
            default:
                return null;
                break;
        }
    }

    /**
     * Set the view file thats going to be use.
     * 
     * @param string $view the name of the file that contains the view, without the extension.
     */
    public function set_view($view)
    {
        if( !file_exists( "$this->root/$view.phtml" ) )
        { $this->log['file_missing'] = "The view file <{$view}> you add is not valid."; }

        $this->name     = "$view"; 
        $this->view     = "$view.phtml";
        $this->filename = "$this->root/$view.phtml";
    }


    /**
     * Set an array of values into the view
     * 
     * @param array $values 
     */
    public function set_values($values, $ly = null)
    {

        if( $ly == 'ly' )
        {
            $this->ly = array_merge(
                $this->vw,
                $values
            );
            return; 
        }

        $this->vw = array_merge(
            $this->vw,
            $values
        );

    }

    /**
     * Set an individual value into the view
     * 
     * @param array $value
     */
    public function set_value($name, $value, $ly = null)
    {
        if( $ly == 'ly' )
        {
            $this->ly[$name] = $value;
            return; 
        }

        $this->vw[$name] = $value;
    }
    
    /**
     * Prints a vw value
     * 
     * @param string $reference Name of the vw that you want to access
     */
    private function get_value($reference, $ly = false)
    {

        if($ly == true)
        {
            return isset( $this->ly[$reference] ) ? $this->ly[$reference] : null; 
            return; 
        }
        return isset( $this->vw[$reference] ) ? $this->vw[$reference] : null;
    }

    private function apply_filter(&$value, $filter){

        //TODO: Change $value using the $filter
    }
    /**
     * Include the view
     * 
     * @param string $filename
     * @param array  $vw
     */
    private function call_view($filename, $vw){

        function filter($value, $filters)
        { 
            foreach ($filters as $filter)
            { $this->apply_filter($value, $filter); }
            
            echo $value; 
        }

        include($filename);
    }

    private function extend($name)
    {  
        include "{$this->extends}{$name}.layout.phtml";
    }

    /**
     * Include the view file and offer functions
     * 
     * This includes the view file that you call, using call_view private method,
     * call_view offers the functions an variables for easy access in the view file.
     */
    public function render()
    {
        if($this->filename AND empty($this->log) )
        {
            $this->call_view($this->filename, $this->vw);
        }else{
            echo 'Error rendering the view:<br>';
            var_dump($this->log);
        }
    }
}