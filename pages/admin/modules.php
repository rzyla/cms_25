<?php
$provider->database->table(consts::$table_modules);

if ($provider->variables->action == consts::$action_index) {
    $provider->buttons = new buttons(true, false);
    $provider->grid = new grid(true, true, true, false, true);
    $provider->grid->fields([
        "name",
        "file",
        "active_translate",
        "created",
        "modified"
    ]);
    $provider->grid->headers([
        $provider->language->translate("page_modules_header_name"),
        $provider->language->translate("page_modules_header_file"),
        $provider->language->translate("page_modules_header_active"),
        $provider->language->translate("page_modules_header_created"),
        $provider->language->translate("page_modules_header_modified")
    ]);
    $provider->grid->items($provider->database->list("SELECT `id`, `name`, `file`, `active`, `active` AS `active_translate`, `created`, `modified` FROM " . $provider->database->table . " ORDER BY `name` ASC"));
    $provider->grid->translate($provider->language, "active_translate", "dictionary_common_active_");
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$table_modules . "_index"));
    $provider->layout->title($provider->language->translate("title_" . consts::$table_modules . "_index"));
}

if ($provider->variables->action == consts::$action_insert) {
    if ($provider->database->unique($provider->database->table, 'file', $provider->variables->post('file'))) {
        $provider->database->query("INSERT INTO " . $provider->database->table . "(`name`, `file`, `active`) VALUES ('" . $provider->variables->post('name') . "', '" . $provider->variables->post('file') . "', '" . $provider->variables->post('active') . "')");
        $provider->message->message($provider->language->translate("massage_modules_added"), true);
        $provider->route->redirect($provider->route->index(consts::$table_modules));
    } else {
        $provider->variables->action(consts::$action_add);
        $provider->message->message($provider->language->translate("massage_modules_unique_file_error"), false);
    }
}

if ($provider->variables->action == consts::$action_add) {
    $provider->buttons = new buttons(false, true);
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add($provider->route->index(consts::$table_modules), $provider->language->translate("breadcrumb_" . consts::$table_modules . "_index"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$table_modules . "_add"));
    $provider->layout->title($provider->language->translate("title_" . consts::$table_modules . "_add"));
}

if ($provider->variables->action == consts::$action_update) {
    $provider->database->query("UPDATE " . $provider->database->table . " SET `name` = '" . $provider->variables->post('name') . "', `active` = '" . $provider->variables->post('active') . "', `modified` = current_timestamp() WHERE `id` = '" . $provider->variables->id . "'");
    $provider->message->message($provider->language->translate("massage_modules_modified"), true);
    $provider->route->redirect($provider->route->edit(consts::$table_modules, $provider->variables->id));
}

if ($provider->variables->action == consts::$action_edit) {
    $provider->buttons = new buttons(false, true);
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add($provider->route->index(consts::$table_modules), $provider->language->translate("breadcrumb_" . consts::$table_modules . "_index"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$table_modules . "_edit"));
    $provider->layout->title($provider->language->translate("title_" . consts::$table_modules . "_edit"));
    $provider->variables->data($provider->database->item("SELECT `name`, `file`, `active`, `created`, `modified` FROM " . $provider->database->table . " WHERE `id` = '" . $provider->variables->id . "'"));
}

require_once 'partials/admin/actions/active.inc.php';
require_once 'partials/admin/actions/delete.inc.php';

?>