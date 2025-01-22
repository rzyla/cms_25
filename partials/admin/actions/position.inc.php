<?php 

if(!empty($provider->variables->post['position']))
{
    foreach($provider->variables->post['position'] as $key => $value)
    {
        $provider->database->query("UPDATE `" . $provider->database->table . "` SET `" . consts::$fields_position . "` = '" . $value . "' WHERE `id` = '" . $key . "'");
    }
    
    $provider->message->message($provider->language->translate("massage_positions"), true);
    
    
    $redirect = $provider->variables->action == consts::$action_child ? $provider->route->action(consts::$path_child, $provider->variables->page, $provider->variables->id) : $provider->route->index($provider->variables->page);
    $provider->route->redirect($redirect);
}

?>