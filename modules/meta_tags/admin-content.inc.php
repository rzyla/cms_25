<?php 

if($provider->variables->content_action ==  consts::$action_index || $provider->variables->content_action ==  consts::$action_view)
{
    $entity = $provider->database->item("SELECT * FROM " . consts::$table_module_meta_tags . " WHERE `menu_modules_id` = '".$provider->variables->content_id . "' ORDER BY `id` LIMIT 1");
    
    if(empty($entity))
    {
        $provider->content->formContent($provider->route->content($provider->variables->id, $provider->variables->content_id, consts::$action_insert));
    }
    else
    {
        $provider->content->entity($entity);
        $provider->content->formContent($provider->route->content($provider->variables->id, $provider->variables->content_id, consts::$action_update, $entity['id']));
    }
}

if($provider->variables->content_action ==  consts::$action_insert)
{
    $provider->database->query("INSERT INTO " . consts::$table_module_meta_tags . "(`menu_modules_id`, `title`, `description`, `key_words`) VALUES
            (
                '" . $provider->variables->content_id . "',
                '" . $provider->variables->post_module('meta_tags', 'title') . "',
                '" . $provider->variables->post_module('meta_tags', 'description') . "',
                '" . $provider->variables->post_module('meta_tags', 'key_words') . "'
            )");
    
    $provider->message->message($provider->language->translate("massage_content_modified"), consts::$message_success);
    $provider->route->redirect($provider->route->content($provider->variables->id, $provider->variables->content_id, consts::$action_view));
}

if($provider->variables->content_action ==  consts::$action_update)
{
    $provider->database->query("UPDATE " . consts::$table_module_meta_tags . " SET
            `title` = '" . $provider->variables->post_module('meta_tags', 'title') . "',
            `description` = '" . $provider->variables->post_module('meta_tags', 'description') . "',
            `key_words` = '" . $provider->variables->post_module('meta_tags', 'key_words') . "',
            `modified` = current_timestamp()
        WHERE `menu_modules_id` = '" . $provider->variables->content_id . "'");
    
    $provider->message->message($provider->language->translate("massage_content_modified"), consts::$message_success);
    $provider->route->redirect($provider->route->content($provider->variables->id, $provider->variables->content_id, consts::$action_view));
}

?>