<?php

class web
{

    public config $config;

    public database $database;

    public language $language;
    
    public layout $layout;
    
    public menu $menu;
    
    public message $message;
    
    public route $route;
    
    public security $security;
    
    public user $user;
    
    public variables $variables;
    
    function __construct($path)
    {
        $this->config = new config($path);
        
        $this->init_error_reporting($this->config->error_reporting);
        
        $this->database = new database($this->config);
        $this->route = new route($this->config->app_admin_path);
        $this->user = new user($this->database);
        $this->variables = new variables($this->config, $this->database, consts::$provider_web);
        $this->message = new message();
        $this->language = new language($this->config->default_language_admin, consts::$provider_web);
        $this->security = new security($this->config, $this->route, $this->user, $this->variables, $this->message, $this->language);
        $this->menu = new menu($this->database);
        $this->layout = new layout($this->database, $this->language, $this->menu, $this->variables);
    }
    
    private function init_error_reporting(bool $error_reporting)
    {
        // if (! empty($error_reporting) && $error_reporting == true) {
        // ini_set('display_errors', 1);
        // ini_set('error_reporting', E_ERROR | E_PARSE);
        // }
    }

    public function dispose()
    {
        $this->database->dispose();
    }
}