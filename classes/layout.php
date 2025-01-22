<?php

class layout
{

    private breadcrumb $breadcrumb;

    private string $title = "";

    private string $layout;
    
    private array $modules = [];
    
    private array $icons = [];
    
    private database $database;
    
    private language $language;

    function __construct(database $database, language $language)
    {
        $this->database = $database;
        $this->language = $language;
        $this->breadcrumb = new breadcrumb();
        $this->init_modules();
        $this->init_icons();
    }

    public function __get($key)
    {
        if (isset($this->$key))
        {
            return $this->$key;
        }
    }
    
    private function init_modules()
    {
        $list = $this->database->list("SELECT `file`  FROM " . consts::$table_modules . " WHERE `active` = '" . consts::$value_activate . "' AND `type` = '" . consts::$value_module_type_dynamic . "' ORDER BY `" . consts::$fields_position . "` ASC");
        foreach($list as $item)
        {
            $this->modules[$item['file']] = $this->language->translate('module_' . $item['file']);
        }
    }
    
    private function init_icons()
    {
        $this->icons =  
        [
            'module_form' => 'bi-envelope',
            'module_gallery' => 'bi-images',
            'module_html' => 'bi-code-slash',
            'module_simple_gallery' => 'bi-image',
            'module_news' => 'bi-journal',
            'module_meta_tags' => 'bi-bookmark',
        ];
    }

    public function title(string $title)
    {
        $this->title = $title;
    }
}

?>