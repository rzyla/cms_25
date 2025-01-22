<?php
$provider->database->table(consts::$table_users);
$provider->security->accessToPage(consts::$value_acl_user, consts::$page_dashboard);

if ($provider->variables->action != consts::$action_update && $provider->variables->action != consts::$action_edit)
{
    $provider->variables->init_action(consts::$action_edit);
    $provider->variables->init_view();
}

if ($provider->variables->action == consts::$action_update)
{
    if(!empty($_FILES))
    {
        //$file_to_delete = url_upload() . consts::$dir_avatars. '/' . $provider->user->avatar;
        //$file_to_upload = url_upload() . consts::$dir_avatars. '/' . $provider->user->avatar;
        
        if(file_exists($file_to_delete))
        {
            unlink($file_to_delete);
        }
        
        move_uploaded_file($_FILES["file"]["tmp_name"], "../files/gallery/$nazwapliku");
    }
    
    $provider->database->query("UPDATE " . $provider->database->table . " SET `name` = '" . $provider->variables->post('name') . "', `modified` = current_timestamp() WHERE `id` = '" . $provider->user->id . "'");
    if ($provider->variables->post('password') != "")
    {
        $provider->database->query("UPDATE " . $provider->database->table . " SET `password` = '" . $provider->variables->password($provider->variables->post('password')) . "' WHERE `id` = '" . $provider->user->id . "'");
    }
    $provider->message->message($provider->language->translate("massage_users_modified"), true);
    $provider->route->redirect($provider->route->index(consts::$page_account));
}

if ($provider->variables->action == consts::$action_edit)
{
    $provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
    $provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$page_account . "_edit"));
    $provider->layout->title($provider->language->translate("title_" . consts::$page_account . "_edit"));
    $provider->variables->data(consts::$data_entity, $provider->database->item("SELECT `login`, `name`, `acl`, `active`, `created`, `modified` FROM " . $provider->database->table . " WHERE `id` = '" . $provider->user->id . "'"));
}

?>