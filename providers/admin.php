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

    function __construct($path)
    {
        $this->config = new config($path);

        $this->init_error_reporting($this->config->error_reporting);

        $this->language = new language($this->config->default_language_admin, consts::$provider_admin);
        $this->database = new database($this->config);
        $this->route = new route($this->config->app_admin_path);
        $this->user = new user();
        $this->buttons = new buttons();
        $this->variables = new variables($this->config, consts::$provider_admin);
        $this->grid = new grid();
        $this->layout = new layout();
        $this->message = new message();
        $this->dictionary = new dictionary($this->language);
    }

    private function init_error_reporting(bool $error_reporting)
    {
        // if (! empty($error_reporting) && $error_reporting == true) {
        // ini_set('display_errors', 1);
        // ini_set('error_reporting', E_ERROR | E_PARSE);
        // }
    }

    public function menu()
    {
        $menu = new menu();
        return $menu->tree($this->database);
    }

    public function dispose()
    {
        $this->database->dispose();
    }
}

?>