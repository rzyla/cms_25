<?php

class layout
{

    private breadcrumb $breadcrumb;

    private string $title = "";

    private string $layout;

    private array $modules = [ ];

    private array $icons = [ ];

    private array $menu_tree = [ ];
    
    private array $include_in_header = [ ];
    
    private array $include_in_footer = [ ];

    private database $database;

    private language $language;

    private menu $menu;
    
    private variables $variables;

    function __construct(database $database, language $language, menu $menu, variables $variables)
    {
        $this->database = $database;
        $this->language = $language;
        $this->menu = $menu;
        $this->breadcrumb = new breadcrumb();
        $this->variables = $variables;
        $this->init_modules();
        $this->init_icons();
        $this->init_menu_tree();
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
        $list = $this->database->list("SELECT `file`  FROM " . consts::$table_modules . " WHERE `active` = '" . consts::$value_activate . "' AND (`type` = '" . consts::$value_module_type_dynamic_single . "' OR `type` = '" . consts::$value_module_type_dynamic_multi . "' OR `type` = '" . consts::$value_module_type_partial . "') ORDER BY `" . consts::$fields_position . "` ASC");
        foreach($list as $item)
        {
            $this->modules[$item['file']] = $this->language->translate('module_' . $item['file']);
        }
    }

    private function init_icons()
    {
        $this->icons = [ 
            'module_form' => 'bi-envelope',
            'module_gallery' => 'bi-images',
            'module_html' => 'bi-code-slash',
            'module_simple_gallery' => 'bi-image',
            'module_news' => 'bi-journal',
            'module_meta_tags' => 'bi-bookmark',
            'module_slider' => 'bi-view-list',
            'module_carousel' => 'bi-view-stacked'
        ];
    }

    private function init_menu_tree()
    {
        if($this->variables->page == consts::$page_content)
        {
            foreach($this->menu->tree_revert($this->variables->id) as $menu)
            {
                $this->menu_tree[$menu['id']] = $menu['id'];
            }
        }
    }

    public function title(string $title)
    {
        $this->title = $title;
    }
    
    public function include_in_header(string $include)
    {
        $this->include_in_header[] = $include;
    }
    
    public function include_in_footer(string $include)
    {
        $this->include_in_footer[] = $include;
    }
}

?>