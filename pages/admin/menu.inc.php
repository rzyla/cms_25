<?php
$provider->database->table(consts::$table_menu);
$provider->security->accessToPage(consts::$value_acl_admin, consts::$page_dashboard);

if ($provider->variables->action == consts::$action_index)
{
    $provider->buttons->add();

    $provider->grid = new grid();
    $provider->grid->actions->edit();
    $provider->grid->actions->delete();

    $provider->grid->fields([ 
        "name",
        "type_translate",
        "created",
        "modified"
    ]);
    $provider->grid->headers([ 
        $provider->language->translate("page_menu_header_name"),
        $provider->language->translate("page_menu_header_type"),
        $provider->language->translate("page_menu_header_created"),
        $provider->language->translate("page_menu_header_modified")
    ]);
    $provider->grid->items($provider->database->list("SELECT `id`, `name`, `type`, `type` AS `type_translate`, `created`, `modified` FROM " . $provider->database->table . " WHERE `parent_id` IS NULL OR `parent_id` = '0' ORDER BY `name` ASC"));
    $provider->grid->translate($provider->language, "type_translate", "dictionary_common_menu_");

    foreach($provider->grid->items as $key => $item)
    {
        if ($item['type'] == consts::$value_menu_parent || $item['type'] == consts::$value_menu_parent_content)
        {
            $provider->grid->actions->custom($item['id'], new grid_actions_custom_item($provider->route->action(consts::$path_child, consts::$page_menu, $item['id']), $provider->language->translate("common_button_menu"), 'bi-list'));
        }

        if ($item['type'] == consts::$value_menu_parent_content)
        {
            $provider->grid->actions->custom($item['id'], new grid_actions_custom_item($provider->route->action(consts::$path_manage, consts::$page_menu, $item['id']), $provider->language->translate("common_button_manage"), 'bi-gear'));
        }
    }

    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$page_menu . "_index"));
    $provider->layout->title($provider->language->translate("title_" . consts::$page_menu . "_index"));
}

if ($provider->variables->action == consts::$action_child)
{
    $entity = $provider->database->item("SELECT `parent_id`, `name`, `symbol`, `url`, `type`, `target`, `active`, `created`, `modified` FROM " . $provider->database->table . " WHERE `id` = '" . $provider->variables->id . "'");
    
    
    $provider->grid = new grid();
    $provider->grid->actions->edit();
    $provider->grid->actions->delete();
    $provider->grid->actions->active();
    $provider->grid->actions->position();
    $provider->buttons->add($provider->variables->id);
    $provider->buttons->position();
    //$provider->buttons->list($provider->variables->get_value('parent_id', $entity));
   // $provider->buttons->back();
    //$provider->buttons->add();
    
    

    //$parent = $provider->database->item("SELECT `id`, `parent_id`, `name` FROM " . $provider->database->table . " WHERE `id` = '" . $provider->variables->id . "'");


    //if (!empty($parent['id']))
    //{
    //    $provider->buttons->button(new button_item($provider->route->index(consts::$path_index, consts::$page_menu), consts::$icon_list_icon, consts::$icon_list_class));
    //}

    $provider->grid->fields([ 
        "name",
        "type_translate",
        "target_translate",
        "active_translate",
        "created",
        "modified"
    ]);
    $provider->grid->headers([ 
        $provider->language->translate("page_menu_header_name"),
        $provider->language->translate("page_menu_header_type"),
        $provider->language->translate("page_menu_header_target"),
        $provider->language->translate("page_menu_header_active"),
        $provider->language->translate("page_menu_header_created"),
        $provider->language->translate("page_menu_header_modified")
    ]);

    $provider->grid->items($provider->database->list("SELECT `id`, `name`, `type`, `type` AS `type_translate`, `target` AS `target_translate`,  `active`, `active` AS `active_translate`, `created`, `modified`, `position` FROM " . $provider->database->table . " WHERE `parent_id` = '" . $provider->variables->id . "'  ORDER BY `position` ASC"));
    $provider->grid->translate($provider->language, "active_translate", "dictionary_common_active_");
    $provider->grid->translate($provider->language, "type_translate", "dictionary_common_menu_");
    $provider->grid->translate($provider->language, "target_translate", "dictionary_common_target_");
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$page_menu . "_index"));
    $provider->layout->title($provider->language->translate("title_" . consts::$page_menu . "_index"));
    $provider->variables->data(consts::$data_menu_item, $entity);
    
    foreach($provider->grid->items as $key => $item)
    {
        if ($item['type'] == consts::$value_menu_parent || $item['type'] == consts::$value_menu_parent_content)
        {
            $provider->grid->actions->custom($item['id'], new grid_actions_custom_item($provider->route->action(consts::$path_child, consts::$page_menu, $item['id']), $provider->language->translate("common_button_menu"), 'bi-list'));
        }
        
        if ($item['type'] == consts::$value_menu_parent_content || $item['type'] == consts::$value_menu_content)
        {
            $provider->grid->actions->custom($item['id'], new grid_actions_custom_item($provider->route->action(consts::$path_manage, consts::$page_menu, $item['id']), $provider->language->translate("common_button_manage"), 'bi-gear'));
        }
    }
}

if ($provider->variables->action == consts::$action_insert)
{
    $parent_id = !empty($provider->variables->id) ? $provider->variables->id : 0;
    
    if(!empty($parent_id) || (!empty($provider->variables->post('symbol')) && $provider->database->unique($provider->database->table, 'symbol', $provider->variables->post('symbol'))))
    {
        $position = 1;

        if ($parent_id > 0)
        {
            $position = $provider->database->position(consts::$table_menu, [ 
                'parent_id' => $parent_id
            ]);
        }
        $provider->database->query("INSERT INTO " . $provider->database->table . "(`parent_id`, `name`, `symbol`, `url`, `type`, `target`, `active`, `position`) VALUES 
            (
                '" . $parent_id . "', 
                '" . $provider->variables->post('name') . "', 
                '" . $provider->variables->post('symbol') . "', 
                '" . $provider->variables->post('url') . "', 
                '" . $provider->variables->post('type') . "', 
                '" . $provider->variables->post('target') . "', 
                '" . $provider->variables->post('active') . "', 
                '" . $position . "'
            )");
        $provider->message->message($provider->language->translate("massage_menu_added"), true);

        $redirect = !empty($parent_id) ? $provider->route->child(consts::$page_menu, $parent_id) : $provider->route->index(consts::$page_menu);

        $provider->route->redirect($redirect);
    }
    else
    {
        $provider->variables->action(consts::$action_add);
        $provider->variables->init_view();
        $provider->message->message($provider->language->translate("massage_menu_add_error"), false);

        if (!$provider->database->unique($provider->database->table, 'symbol', $provider->variables->post('symbol')))
        {
            $provider->variables->error('symbol', $provider->language->translate("massage_menu_unique_symbol_error"));
        }

        if (!$provider->database->unique($provider->database->table, 'url', $provider->variables->post('url')))
        {
            $provider->variables->error('url', $provider->language->translate("massage_menu_unique_url_error"));
        }
    }
}

if ($provider->variables->action == consts::$action_add)
{
    $entity = $provider->variables->id != null ? $provider->database->item("SELECT `parent_id`, `name`, `symbol`, `url`, `type`, `target`, `active`, `created`, `modified` FROM " . $provider->database->table . " WHERE `id` = '" . $provider->variables->id . "'") : [];

    $provider->buttons->back(url_back($provider, consts::$page_menu, $provider->variables->get_value('parent_id', $entity)));
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add($provider->route->index(consts::$page_menu), $provider->language->translate("breadcrumb_" . consts::$page_menu . "_index"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$page_menu . "_add"));
    $provider->layout->title($provider->language->translate("title_" . consts::$page_menu . "_add"));
    $provider->variables->data(consts::$data_menu_item, $entity);
}

if ($provider->variables->action == consts::$action_update)
{
    if ($provider->database->unique($provider->database->table, 'symbol', $provider->variables->post('symbol'), $provider->variables->id) && $provider->database->unique($provider->database->table, 'url', $provider->variables->post('url'), $provider->variables->id))
    {
        $provider->database->query("UPDATE " . $provider->database->table . " SET 
            `name` = '" . $provider->variables->post('name') . "', 
            `symbol` = '" . $provider->variables->post('symbol') . "',
            `url` = '" . $provider->variables->post('url') . "',
            `type` = '" . $provider->variables->post('type') . "',
            `target` = '" . $provider->variables->post('target') . "',
            `active` = '" . $provider->variables->post('active') . "',
            `modified` = current_timestamp() 
        WHERE `id` = '" . $provider->variables->id . "'");

        $provider->message->message($provider->language->translate("massage_menu_modified"), true);
        $provider->route->redirect($provider->route->edit(consts::$page_menu, $provider->variables->id));
    }
    else
    {
        $provider->variables->action(consts::$action_edit, $provider->variables->id);
        $provider->message->message($provider->language->translate("massage_menu_add_error"), false);

        if (!$provider->database->unique($provider->database->table, 'symbol', $provider->variables->post('symbol'), $provider->variables->id))
        {
            $provider->variables->error('symbol', $provider->language->translate("massage_menu_unique_symbol_error"));
        }

        if (!$provider->database->unique($provider->database->table, 'url', $provider->variables->post('url'), $provider->variables->id))
        {
            $provider->variables->error('url', $provider->language->translate("massage_menu_unique_url_error"));
        }
    }
}

if ($provider->variables->action == consts::$action_edit)
{
    $entity = $provider->database->item("SELECT `parent_id`, `name`, `symbol`, `url`, `type`, `target`, `active`, `created`, `modified` FROM " . $provider->database->table . " WHERE `id` = '" . $provider->variables->id . "'");

    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add($provider->route->index(consts::$page_menu), $provider->language->translate("breadcrumb_" . consts::$page_menu . "_index"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$page_menu . "_edit"));
    $provider->layout->title($provider->language->translate("title_" . consts::$page_menu . "_edit"));
    $provider->buttons->back(url_back($provider, consts::$page_menu, $provider->variables->get_value('parent_id', $entity)));
    $provider->variables->data(consts::$data_entity, $entity);
    $provider->variables->data(consts::$data_menu_item, $entity);
}

if ($provider->variables->action == consts::$action_manage && $provider->variables->sub_action == consts::$action_submit)
{
    $provider->database->query("INSERT INTO `menu_modules` (`menu_id`, `module_id`) VALUES ('" . $provider->variables->id . "', '" . $provider->variables->post('module_id') . "')");
    $provider->message->message($provider->language->translate("massage_menu_manage_submit"), true);
    $provider->route->redirect($provider->route->action(consts::$path_manage, consts::$page_menu, $provider->variables->id));
}

if ($provider->variables->action == consts::$action_manage && $provider->variables->sub_action == consts::$action_delete)
{
    $provider->database->query("DELETE FROM `menu_modules` WHERE `id` = '" . $provider->variables->sub_id . "'");
    $provider->message->message($provider->language->translate("massage_menu_manage_delete"), true);
    $provider->route->redirect($provider->route->action(consts::$path_manage, consts::$page_menu, $provider->variables->id));
}

if ($provider->variables->action == consts::$action_manage)
{
    $entity = $provider->database->item("SELECT `parent_id`, `name`, `symbol`, `url`, `type`, `target`, `active`, `created`, `modified` FROM " . $provider->database->table . " WHERE `id` = '" . $provider->variables->id . "'");
    
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add($provider->route->index(consts::$page_menu), $provider->language->translate("breadcrumb_" . consts::$page_menu . "_index"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$page_menu . "_manage"));
    $provider->layout->title($provider->language->translate("title_" . consts::$page_menu . "_manage"));
    $provider->buttons->back(url_back($provider, consts::$page_menu, $provider->variables->get_value('parent_id', $entity)));
    $provider->variables->data(consts::$data_entity, $provider->database->item("SELECT `parent_id`, `name`, `symbol`, `url`, `type`, `target`, `active`, `created`, `modified` FROM " . $provider->database->table . " WHERE `id` = '" . $provider->variables->id . "'"));
    $provider->variables->data(consts::$data_modules, $provider->dictionary->modules_key_translate());
    $provider->variables->data(consts::$data_manage, $provider->database->list("SELECT `id`, `module_id` FROM " . consts::$table_menu_modules . " WHERE `menu_id` = '" . $provider->variables->id . "'"));
    $provider->variables->data(consts::$menu_breadcrumb, $provider->menu->tree_revert($provider->variables->get_value('parent_id', $entity)));
    $provider->variables->data(consts::$data_menu_item, $entity);    
}

// DELETE CONTENT FROM MODULES

require_once 'partials/admin/actions/active.inc.php';
require_once 'partials/admin/actions/delete.inc.php';
require_once 'partials/admin/actions/position.inc.php';

?>