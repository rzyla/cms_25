<?php
$provider->database->table(consts::$table_partials);
$provider->security->accessToPage(consts::$value_acl_admin, consts::$page_dashboard);

if ($provider->variables->action == consts::$action_index)
{
    if ($provider->user->acl == consts::$value_acl_supervisor)
    {
        $provider->buttons->add();
        $provider->grid->actions->delete();
        $provider->grid->actions->edit();
    }

    // TODO: Zarządzaj

    $provider->grid->fields([ 
        "name",
        "module_translate",
        "symbol",
        "created",
        "modified"
    ]);
    $provider->grid->headers([ 
        $provider->language->translate("page_partials_header_name"),
        $provider->language->translate("page_partials_header_module_translate"),
        $provider->language->translate("page_partials_header_symbol"),
        $provider->language->translate("page_partials_header_created"),
        $provider->language->translate("page_partials_header_modified")
    ]);
    $provider->grid->items($provider->database->list("SELECT `p`.`id`, `p`.`name`, `m`.`file` as `module_translate`, `p`.`symbol`, `p`.`created`, `p`.`modified` FROM " . $provider->database->table . " p JOIN " . consts::$table_modules . " m ON p.module_id = m.id ORDER BY p.name ASC"));
    $provider->grid->translate_from_dictionary("module_translate", $provider->dictionary->modules());
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$table_partials . "_index"));
    $provider->layout->title($provider->language->translate("title_" . consts::$table_partials . "_index"));
}

if ($provider->variables->action == consts::$action_insert)
{
    if ($provider->user->acl != consts::$value_acl_supervisor)
    {
        $provider->security->denyAccessRedirect();
    }

    if ($provider->database->unique($provider->database->table, 'symbol', $provider->variables->post('symbol')) && !empty($provider->variables->post('name')))
    {
        $provider->database->query("INSERT INTO " . $provider->database->table . "(`module_id`, `name`, `symbol`, `created`) VALUES ('" . $provider->variables->post('module_id') . "', '" . $provider->variables->post('name') . "', '" . $provider->variables->post('symbol') . "', current_timestamp())");
        $provider->message->message($provider->language->translate("massage_modules_added"), consts::$message_success);
        $provider->route->redirect($provider->route->index(consts::$table_partials));
    }
    else
    {
        $provider->variables->action(consts::$action_add);
        $provider->variables->init_view();
        $provider->message->message($provider->language->translate("massage_partials_add_error"), false);

        if (!$provider->database->unique($provider->database->table, 'symbol', $provider->variables->post('symbol')))
        {
            $provider->variables->error('symbol', $provider->language->translate("massage_partials_unique_symbol_error"));
        }

        if (empty($provider->variables->post('name')))
        {
            $provider->variables->error('name', $provider->language->translate("massage_partials_empty_name_error"));
        }
    }
}

if ($provider->variables->action == consts::$action_add)
{
    if ($provider->user->acl != consts::$value_acl_supervisor)
    {
        $provider->security->denyAccessRedirect();
    }

    $provider->buttons->back($provider->route->index(consts::$page_partials));
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add($provider->route->index(consts::$table_partials), $provider->language->translate("breadcrumb_" . consts::$table_partials . "_index"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$table_partials . "_add"));
    $provider->layout->title($provider->language->translate("title_" . consts::$table_partials . "_add"));

    $modules = [ ];
    $modules_list = $provider->database->list("SELECT `id`, `file` FROM " . consts::$table_modules . " WHERE active = ' " . consts::$value_activate . " ' ORDER BY `" . consts::$fields_position . "` ASC");

    foreach($modules_list as $module)
    {
        $modules[$module['id']] = $provider->language->translate("module_" . $module['file']);
    }

    $provider->variables->data(consts::$data_modules, $modules);
}

if ($provider->variables->action == consts::$action_update)
{
    if ($provider->user->acl != consts::$value_acl_supervisor)
    {
        $provider->security->denyAccessRedirect();
    }

    if ($provider->database->unique($provider->database->table, 'symbol', $provider->variables->post('symbol'), $provider->variables->id) && !empty($provider->variables->post('name')))
    {
        $provider->database->query("UPDATE " . $provider->database->table . " SET `name` = '" . $provider->variables->post('name') . "', `symbol` = '" . $provider->variables->post('symbol') . "', `modified` = current_timestamp() WHERE `id` = '" . $provider->variables->id . "'");
        $provider->message->message($provider->language->translate("massage_modules_modified"), consts::$message_success);
        $provider->route->redirect($provider->route->edit(consts::$table_partials, $provider->variables->id));
    }
    else
    {
        $provider->variables->action(consts::$action_edit);
        $provider->variables->init_view();
        $provider->message->message($provider->language->translate("massage_partials_edit_error"), false);

        if (!$provider->database->unique($provider->database->table, 'symbol', $provider->variables->post('symbol'), $provider->variables->id))
        {
            $provider->variables->error('symbol', $provider->language->translate("massage_partials_unique_symbol_error"));
        }

        if (empty($provider->variables->post('name')))
        {
            $provider->variables->error('name', $provider->language->translate("massage_partials_empty_name_error"));
        }
    }
}

if ($provider->variables->action == consts::$action_edit)
{
    if ($provider->user->acl != consts::$value_acl_supervisor)
    {
        $provider->security->denyAccessRedirect();
    }
    
    $provider->buttons->back($provider->route->index(consts::$page_partials));
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add($provider->route->index(consts::$table_partials), $provider->language->translate("breadcrumb_" . consts::$table_partials . "_index"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$table_partials . "_edit"));
    $provider->layout->title($provider->language->translate("title_" . consts::$table_partials . "_edit"));
    $provider->variables->data(consts::$data_entity, $provider->database->item("SELECT `name`, `module_id`, `symbol`, `created`, `modified` FROM " . $provider->database->table . " WHERE `id` = '" . $provider->variables->id . "'"));
    
    $modules = [ ];
    $modules_list = $provider->database->list("SELECT `id`, `file` FROM " . consts::$table_modules . " WHERE active = ' " . consts::$value_activate . " ' ORDER BY `" . consts::$fields_position . "` ASC");
    
    foreach($modules_list as $module)
    {
        $modules[$module['id']] = $provider->language->translate("module_" . $module['file']);
    }
    
    $provider->variables->data(consts::$data_modules, $modules);
    
}

if ($provider->user->acl == consts::$value_acl_supervisor)
{
    require_once 'partials/admin/actions/delete.inc.php';
}
?>