<?php

class admin
{

    public $buttons;

    public $config;

    public $database;

    public $dictionary;

    public $grid;

    public $language;

    public $layout;

    public $message;

    public $route;

    public $user;

    public $variables;

    public $security;
    
    public $menu;

    function __construct($path)
    {
        $this->config = new config($path);

        $this->init_error_reporting($this->config->error_reporting);

        $this->database = new database($this->config);
        $this->route = new route($this->config->app_admin_path);
        $this->user = new user($this->database);
        $this->variables = new variables($this->config, consts::$provider_admin);
        $this->message = new message();
        $this->language = new language($this->config->default_language_admin, consts::$provider_admin);
        $this->security = new security($this->config, $this->route, $this->user, $this->variables, $this->message, $this->language);
        $this->buttons = new buttons($this->route, $this->variables);
        $this->grid = new grid();
        $this->dictionary = new dictionary($this->language, $this->database);
        $this->layout = new layout($this->database, $this->language);
        $this->menu = new menu($this->database);
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

?>