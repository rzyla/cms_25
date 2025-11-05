<?php
$provider->database->table(consts::$table_users);
$provider->security->accessToPage(consts::$value_acl_user, consts::$page_dashboard);

if ($provider->variables->action != consts::$action_update && $provider->variables->action != consts::$action_edit)
{
    $provider->variables->set_action(consts::$action_edit);
}

if ($provider->variables->action == consts::$action_update)
{
    if ($provider->variables->post('avatar_delete') != "")
    {
        $provider->files->delete($provider->files->path([ 
            $provider->config->path_upload,
            consts::$dir_avatars,
            $provider->user->avatar
        ]));
        $provider->files->delete($provider->files->path([ 
            $provider->config->path_upload_images,
            consts::$dir_avatars,
            $provider->user->avatar
        ]));
        
        $provider->user->avatar('');
    }

    if (array_key_exists("avatar", $_FILES) && !empty($_FILES["avatar"]["name"]))
    {      
        $upload_error = false;

        $provider->files->delete($provider->files->path([ 
            $provider->config->path_upload,
            consts::$dir_avatars,
            $provider->user->avatar
        ]));
        $provider->files->delete($provider->files->path([ 
            $provider->config->path_upload_images,
            consts::$dir_avatars,
            $provider->user->avatar
        ]));

        $upload_file_name = $provider->files->name($_FILES["avatar"]["name"]);

        if (empty($upload_file_name))
        {
            $provider->message->message($provider->language->translate("massage_account_upload_error"), false);
            $provider->route->redirect($provider->route->index(consts::$page_account));
        }

        $upload_path = $provider->files->path([ 
            $provider->config->path_upload,
            consts::$dir_avatars,
            $upload_file_name
        ]);

        if ($provider->files->upload($_FILES["avatar"]["tmp_name"], $upload_path))
        {
            $images_path = $provider->files->path([ 
                $provider->config->path_upload_images,
                consts::$dir_avatars,
                $upload_file_name
            ]);

            files_resize($upload_path, $images_path, 200, 200);
        }
        else
        {
            $provider->message->message($provider->language->translate("massage_account_upload_error"), false);
            $provider->route->redirect($provider->route->index(consts::$page_account));
        }

        $provider->user->avatar($upload_file_name);
    }

    $provider->database->query("UPDATE " . $provider->database->table . " SET `name` = '" . $provider->variables->post('name') . "', `avatar` = '" . $provider->user->avatar . "', `modified` = current_timestamp() WHERE `id` = '" . $provider->user->id . "'");
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