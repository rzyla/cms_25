<?php
$provider->database->table(consts::$table_configuration);
$provider->security->accessToPage(consts::$value_acl_admin, consts::$page_dashboard);

if ($provider->variables->action != consts::$action_update && $provider->variables->action != consts::$action_edit)
{
    $provider->variables->init_action(consts::$action_edit);
    $provider->variables->init_view();
}

if ($provider->variables->action == consts::$action_edit)
{
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$page_configuration . "_edit"));
    $provider->layout->title($provider->language->translate("title_" . consts::$page_configuration . "_edit"));

    $modules = [ ];
    $where = !$provider->security->acl(consts::$value_acl_supervisor) ? " AND `file` != '" . consts::$module_contact . "' " : "";
    $list = $provider->database->list("SELECT `id`, `file` FROM " . consts::$table_modules . " m WHERE `active` = '" . consts::$value_activate . "' " . $where . " ORDER BY `" . consts::$fields_position . "` ASC");

    foreach($list as $module)
    {
        $entity = [ ];
        $entity_list = $provider->database->list("SELECT `key`, `value` FROM " . $provider->database->table . " WHERE `module_file` = '" . $module["file"] . "' ");

        $view = sprintf(consts::$path_module_configuration, $this->provider, $module["file"]);

        foreach($entity_list as $value)
        {
            $entity[$value["key"]] = $value["value"];
        }

        $modules[] = new module($module["id"], $module["file"], $view, $entity);
    }

    $provider->variables->data(consts::$data_modules, $modules);
}

if ($provider->variables->action == consts::$action_update)
{
    if (!empty($provider->variables->post('configuration')))
    {
        foreach($provider->variables->post('configuration') as $file => $configuration)
        {
            $module = $provider->database->item("SELECT `id`, `file` FROM " . consts::$table_modules . " WHERE `file` = '" . $file . "'");
            $provider->database->query("DELETE FROM " . $provider->database->table . " WHERE `module_file` = '" . $module['file'] . "'");

            foreach($configuration as $key => $value)
            {
                $provider->database->query("INSERT INTO " . $provider->database->table . "(`module_id`, `module_file`, `key`, `value`, `created`) VALUES ('" . $module['id'] . "', '" . $module['file'] . "', '" . $key . "', '" . $value . "', current_timestamp())");
            }
        }
    }

    $provider->message->message($provider->language->translate("massage_configuration_modified"), consts::$message_success);
    $provider->route->redirect($provider->route->index(consts::$page_configuration));
}

?>