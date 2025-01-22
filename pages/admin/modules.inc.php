<?php
$provider->database->table(consts::$table_modules);
$provider->security->accessToPage(consts::$value_acl_supervisor, consts::$page_dashboard);

if ($provider->variables->action == consts::$action_index)
{
    $provider->buttons->add();
    $provider->buttons->position();
    $provider->grid = new grid();
    $provider->grid->actions->edit();
    $provider->grid->actions->active();
    $provider->grid->actions->position();
    $provider->grid->actions->delete();

    $provider->grid->fields([ 
        "file",
        "name_translate",
        "type_translate",
        "active_translate",
        "created",
        "modified"
    ]);
    $provider->grid->headers([ 
        $provider->language->translate("page_modules_header_file"),
        $provider->language->translate("page_modules_header_name"),
        $provider->language->translate("page_modules_header_type"),
        $provider->language->translate("page_modules_header_active"),
        $provider->language->translate("page_modules_header_created"),
        $provider->language->translate("page_modules_header_modified")
    ]);
    $provider->grid->items($provider->database->list("SELECT `id`, `file` as `name_translate`, `file`, `type` as `type_translate`, `active`, `active` AS `active_translate`, `position`, `created`, `modified` FROM " . $provider->database->table . " ORDER BY `" . consts::$fields_position . "` ASC"));
    $provider->grid->translate_from_dictionary("name_translate", $provider->dictionary->modules());
    $provider->grid->translate_from_dictionary("type_translate", $provider->dictionary->modules_type());
    $provider->grid->translate($provider->language, "active_translate", "dictionary_common_active_");
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$table_modules . "_index"));
    $provider->layout->title($provider->language->translate("title_" . consts::$table_modules . "_index"));
}

if ($provider->variables->action == consts::$action_insert)
{
    if ($provider->database->unique($provider->database->table, 'file', $provider->variables->post('file')))
    {
        $provider->database->query("INSERT INTO " . $provider->database->table . "(`file`, `active`, `type`) VALUES ('" . $provider->variables->post('file') . "', '" . $provider->variables->post('active') . "', '" . $provider->variables->post('type') . "')");
        $provider->message->message($provider->language->translate("massage_modules_added"), consts::$message_success);
        $provider->route->redirect($provider->route->index(consts::$table_modules));
    }
    else
    {
        $provider->variables->action(consts::$action_add);
        $provider->message->message($provider->language->translate("massage_modules_unique_file_error"), consts::$message_error);
    }
}

if ($provider->variables->action == consts::$action_add)
{
    $provider->buttons->back($provider->route->index(consts::$page_modules));
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add($provider->route->index(consts::$table_modules), $provider->language->translate("breadcrumb_" . consts::$table_modules . "_index"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$table_modules . "_add"));
    $provider->layout->title($provider->language->translate("title_" . consts::$table_modules . "_add"));

    $modules = $provider->dictionary->modules();
    $provider->variables->diff_by_key($modules, $provider->database->dictionary("SELECT DISTINCT `file` FROM " . $provider->database->table . "", "file"));
    $provider->variables->data(consts::$data_modules, $modules);
    $provider->variables->data(consts::$data_types, $provider->dictionary->modules_type());
}

if ($provider->variables->action == consts::$action_update)
{
    $provider->database->query("UPDATE " . $provider->database->table . " SET `active` = '" . $provider->variables->post('active') . "', `modified` = current_timestamp() WHERE `id` = '" . $provider->variables->id . "'");
    $provider->message->message($provider->language->translate("massage_modules_modified"), consts::$message_success);
    $provider->route->redirect($provider->route->edit(consts::$table_modules, $provider->variables->id));
}

if ($provider->variables->action == consts::$action_edit)
{
    $provider->buttons->back($provider->route->index(consts::$page_modules));
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add($provider->route->index(consts::$table_modules), $provider->language->translate("breadcrumb_" . consts::$table_modules . "_index"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$table_modules . "_edit"));
    $provider->layout->title($provider->language->translate("title_" . consts::$table_modules . "_edit"));
    $provider->variables->data(consts::$data_entity, $provider->database->item("SELECT `file`, `active`, `created`, `modified` FROM " . $provider->database->table . " WHERE `id` = '" . $provider->variables->id . "'"));
    $provider->variables->data(consts::$data_types, $provider->dictionary->modules_type());
}

require_once 'partials/admin/actions/delete.inc.php';
require_once 'partials/admin/actions/active.inc.php';
require_once 'partials/admin/actions/position.inc.php';

?>