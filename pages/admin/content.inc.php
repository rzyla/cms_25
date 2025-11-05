<?php

if($provider->variables->content_id == null || $provider->variables->content_id == 0)
{
    $module = $provider->database->item("SELECT `mm`.`id` FROM `" . consts::$table_menu_modules . "` mm
        JOIN `" . consts::$table_modules . "` m on `mm`.`module_id` = `m`.`id`
        WHERE `mm`.`menu_id` = '" . $provider->variables->id . "' AND (`m`.`type`  = '" . consts::$value_module_type_dynamic_single . "' OR `m`.`type`  = '" . consts::$value_module_type_dynamic_multi . "') AND `m`.`active` = '" . consts::$value_activate . "' ORDER BY `mm`.`" . consts::$fields_position . "` ASC LIMIT 1");
    
    if(!empty($module))
    {
        $provider->route->redirect($provider->route->content($provider->variables->id, $module['id'], consts::$action_view));
    }
    else
    {
        $provider->variables->set_action(consts::$action_error);
    }
}

if ($provider->variables->action == consts::$action_error)
{
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_content_error"));
    $provider->layout->title($provider->language->translate("breadcrumb_content_error"));
}

if ($provider->variables->action == consts::$action_update)
{
    $module = $provider->database->item("SELECT `mm`.`id`, `mm`.`module_id`, `m`.`file` as `module_file` FROM `" . consts::$table_menu_modules . "` mm
        JOIN `" . consts::$table_modules . "` m on `mm`.`module_id` = `m`.`id`
        WHERE `mm`.`id` = '" . $provider->variables->content_id . "' AND (`m`.`type`  = '" . consts::$value_module_type_dynamic_single . "' OR `m`.`type`  = '" . consts::$value_module_type_dynamic_multi . "') AND `m`.`active` = '" . consts::$value_activate . "'");
    
    if(!empty($module['module_file']))
    {
        require_once sprintf(consts::$path_content_module_provider, $module['module_file'], $this->provider);
    }
    else
    {
        $provider->message->error($provider->language->translate("massage_content_modified"), consts::$message_success);
    }

    $provider->route->redirect($provider->route->content($provider->variables->id, $provider->variables->content_id));
}

if ($provider->variables->action == consts::$action_edit)
{
    $entity = $provider->database->item("SELECT `name` FROM `" . consts::$table_menu . "` m WHERE `m`.`id`= '".$provider->variables->id."'");

    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_content_edit"));
    $provider->layout->title($provider->language->translate("title_content_edit") . ": ". $entity['name']);

    $modules = [ ];
    
    $list = $provider->database->list("SELECT `mm`.`id`, `mm`.`module_id`, `m`.`file` as `module_file` FROM `" . consts::$table_menu_modules . "` mm 
        JOIN `" . consts::$table_modules . "` m on `mm`.`module_id` = `m`.`id`
        WHERE `mm`.`menu_id` = '" . $provider->variables->id . "' AND (`m`.`type`  = '" . consts::$value_module_type_dynamic_single . "' OR `m`.`type`  = '" . consts::$value_module_type_dynamic_multi . "') AND `m`.`" . consts::$fields_active . "` = '" . consts::$value_activate . "' ORDER BY `mm`.`" . consts::$fields_position . "` ASC");
    
    foreach($list as $key => $module)
    {
        $name = $provider->language->translate("module_" . $module['module_file']);
        $view = sprintf(consts::$path_module_view_content_provider, $this->provider, $module["module_file"]);

        if($provider->variables->content_id == $module["id"])
        {
            require_once sprintf(consts::$path_content_module_provider, $module['module_file'], $this->provider);
        }
        
        $modules[] = new module($module["module_id"], $module["module_file"], $view, $provider->content->entity, $module["id"], $name);
    }
    
    $provider->variables->data(consts::$data_modules, $modules);
}

?>