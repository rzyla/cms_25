<?php

class dictionary
{

    private language $language;

    private database $database;

    function __construct(language $language, database $database)
    {
        $this->language = $language;
        $this->database = $database;
    }

    public function active()
    {
        return [ 
            consts::$value_activate => $this->language->translate("common_active"),
            consts::$value_deactivate => $this->language->translate("common_deactive")
        ];
    }

    public function acl()
    {
        return [ 
            consts::$value_acl_none => $this->language->translate("dictionary_common_acl_0"),
            consts::$value_acl_user => $this->language->translate("dictionary_common_acl_1"),
            consts::$value_acl_admin => $this->language->translate("dictionary_common_acl_5"),
            consts::$value_acl_supervisor => $this->language->translate("dictionary_common_acl_9")
        ];
    }

    public function modules()
    {
        return [ 
            consts::$module_form => $this->language->translate("module_form"),
            consts::$module_gallery => $this->language->translate("module_gallery"),
            consts::$module_html => $this->language->translate("module_html"),
            consts::$module_simple_gallery => $this->language->translate("module_simple_gallery"),
            consts::$module_news => $this->language->translate("module_news"),
            consts::$module_meta_tags => $this->language->translate("module_meta_tags"),
            consts::$module_maintenance => $this->language->translate("module_maintenance"),
            consts::$module_contact => $this->language->translate("module_contact"),
            consts::$module_slider => $this->language->translate("module_slider"),
            consts::$module_carousel => $this->language->translate("module_carousel")
        ];
    }

    public function modules_type()
    {
        return [ 
            consts::$value_module_type_static => $this->language->translate("dictionary_common_module_static"),
            consts::$value_module_type_dynamic_single => $this->language->translate("dictionary_common_module_dynamic_single"),
            consts::$value_module_type_dynamic_multi => $this->language->translate("dictionary_common_module_dynamic_multi"),
            consts::$value_module_type_partial => $this->language->translate("dictionary_common_module_partial")
        ];
    }

    public function modules_key_translate(bool $all = true)
    {
        $modules = [ ];
        $modules_where = $all == false ? " AND (`type` = '" . consts::$value_module_type_dynamic_single . "' OR `type` = '" . consts::$value_module_type_dynamic_multi . "' OR `type` = '" . consts::$value_module_type_partial . "')  " : "";
        $modules_list = $this->database->list("SELECT `id`, `file` FROM " . consts::$table_modules . " WHERE active = ' " . consts::$value_activate . " ' " . $modules_where . " ORDER BY `" . consts::$fields_position . "` ASC");

        foreach($modules_list as $module)
        {
            $modules[$module['id']] = $this->language->translate("module_" . $module['file']);
        }

        return $modules;
    }

    public function menu()
    {
        return [ 
            consts::$value_menu_content => $this->language->translate("dictionary_common_menu_1"),
            consts::$value_menu_parent => $this->language->translate("dictionary_common_menu_2"),
            consts::$value_menu_parent_content => $this->language->translate("dictionary_common_menu_3"),
            consts::$value_menu_url => $this->language->translate("dictionary_common_menu_9")
        ];
    }

    public function target()
    {
        return [ 
            consts::$value_target_self => $this->language->translate("dictionary_common_target_0"),
            consts::$value_target_blank => $this->language->translate("dictionary_common_target_1")
        ];
    }
}

?>