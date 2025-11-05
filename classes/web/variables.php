<?php

class variables
{

    private array $get;

    private array $post;

    private string $provider = "";

    private string $layout = "";

    private config $config;

    private database $database;

    private int $menu_id = 0;

    function __construct(config $config, database $database, string $provider)
    {
        $this->provider = $provider;
        $this->config = $config;
        $this->database = $database;
        $this->init($provider);
    }

    public function __get($key)
    {
        if (isset($this->$key) && !is_object($this->$key))
        {
            return $this->$key;
        }
    }

    private function init()
    {
        $url = !empty($_GET[consts::$url]) ? $_GET[consts::$url] : "";

        $explode = explode(consts::$slash, $url);

        if (empty($explode[0]))
        {
            $menu_selected = $this->database->item("SELECT `value` FROM " . consts::$table_configuration . " WHERE `key` = '" . consts::$value_configuration_default_menu . "' ");
            $menu_id = $menu_selected['value'];
        }
        else
        {}

        $modules = $this->database->list("SELECT * FROM `" . consts::$table_menu_modules . "` mm JOIN `" . consts::$table_modules . "` m ON `m`.`id`  = `mm`.`module_id` WHERE `mm`.`menu_id` = '" . $menu_id . "' order BY `mm`.`position` ASC");
        
        print_r($modules);

        $this->layout = consts::$layout_default;

        $this->set_get();
        $this->set_post();
    }

    private function set_get()
    {}

    private function set_post()
    {
        $this->post = $_POST;
    }
}

?>