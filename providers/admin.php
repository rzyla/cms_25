<?php

class admin
{

    public $config;

    public $language;

    public $database;

    public $route;

    public $data;

    public $user;

    public $buttons;

    public $variables;

    function __construct($path)
    {
        $this->config = new config($path);

        $this->init_error_reporting($this->config->error_reporting());

        $this->language = new language($this->config->default_language_admin(), "admin");
        $this->database = new database($this->config);
        $this->route = new route($this->config->app_admin_path());
        $this->user = new user();
        $this->buttons = new buttons();
        $this->variables = new variables(consts::$admin);
    }

    private function init_error_reporting(bool $error_reporting)
    {
        if (! empty($error_reporting) && $error_reporting == true) {
            ini_set('display_errors', 1);
            ini_set('error_reporting', E_ERROR | E_PARSE);
        }
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