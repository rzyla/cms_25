<?php
$provider->database->table(consts::$table_users);

if ($provider->variables->action == consts::$action_update || $provider->variables->action == consts::$action_edit) {
    if ($provider->variables->action == consts::$action_update) {
        if ($provider->variables->id == $provider->user->id) {
            $provider->database->query("UPDATE " . $provider->database->table . " SET `name` = '" . $provider->variables->post('name') . "', `modified` = current_timestamp() WHERE `id` = '" . $provider->user->id . "'");
            if ($provider->variables->post('password') != "") {
                $provider->database->query("UPDATE " . $provider->database->table . " SET `password` = '" . $provider->variables->password($provider->variables->post('password')) . "' WHERE `id` = '" . $provider->user->id . "'");
            }
            $provider->message->message($provider->language->translate("massage_users_modified"), true);
        }
        $provider->route->redirect($provider->route->edit(consts::$page_account, $provider->user->id));
    }

    if ($provider->variables->action == consts::$action_edit) {
        $provider->buttons = new buttons(false, false);
        $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
        $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$page_account . "_edit"));
        $provider->layout->title($provider->language->translate("title_" . consts::$page_account . "_edit"));
        $provider->variables->data($provider->database->item("SELECT `login`, `name`, `acl`, `active`, `created`, `modified` FROM " . $provider->database->table . " WHERE `id` = '" . $provider->user->id . "'"));
    }
} else {
    $provider->route->redirect($provider->route->edit(consts::$page_account, $provider->user->id));
}

?>