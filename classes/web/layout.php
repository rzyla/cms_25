<?php 

class layout
{
    private string $meta_title = "";
    private string $meta_description = "";
    private string $meta_key_words = "";
    
    private database $database;
    
    private language $language;
    
    private menu $menu;
    
    private variables $variables;
    
    function __construct(database $database, language $language, menu $menu, variables $variables)
    {
        $this->database = $database;
        $this->language = $language;
        $this->menu = $menu;
        $this->variables = $variables;
        $this->init_meta();
    }
    
    
    public function __get($key)
    {
        if (isset($this->$key))
        {
            return $this->$key;
        }
    }
    
    private function init_meta() 
    {
        if($this->variables->menu_id > 0)
        {
            $item = $this->database->item("SELECT `mmt`.`title`, `mmt`.`description`, `mmt`.`key_words` FROM " . consts::$table_menu_modules . " `mm` JOIN " . consts::$table_module_meta_tags . " `mmt` ON `mm`.`id` = `mmt`.`menu_modules_id`  WHERE `mm`.`menu_id` = '" . $this->variables->menu_id . "' LIMIT 1");
            
            $this->meta_title = $item['title'];
            $this->meta_description = $item['description'];
            $this->meta_key_words = $item['key_words'];
        }
        
        $this->meta_title = empty($this->meta_title) 
            ? $this->database->value("SELECT `value` FROM " . consts::$table_configuration . " WHERE `module_file` = '" . consts::$module_meta_tags . "' AND `key` = '" . consts::$value_configuration_meta_tags_title . "' ") 
            : $this->meta_title;
        $this->meta_description = empty($this->meta_description) 
            ? $this->database->value("SELECT `value` FROM " . consts::$table_configuration . " WHERE `module_file` = '" . consts::$module_meta_tags . "' AND `key` = '" . consts::$value_configuration_meta_tags_description . "' ") 
            : $this->meta_description;
        $this->meta_key_words = empty($this->meta_key_words) 
            ? $this->database->value("SELECT `value` FROM " . consts::$table_configuration . " WHERE `module_file` = '" . consts::$module_meta_tags . "' AND `key` = '" . consts::$value_configuration_meta_tags_key_words . "' ") 
            : $this->meta_key_words;
    }
}

?>