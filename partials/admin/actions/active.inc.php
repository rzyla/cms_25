<?php
if ($provider->variables->action == consts::$action_activate) 
{
    $provider->database->query("UPDATE `" . $provider->database->table . "` SET `" . consts::$fields_active . "` = '" . consts::$value_activate . "', `modified` = current_timestamp() WHERE `id` = '" . $provider->variables->id . "'");
    $provider->message->message($provider->language->translate("massage_activate"), true);
    $provider->route->redirect($provider->route->index($provider->variables->page));
}
if ($provider->variables->action == consts::$action_deactivate) 
{
    $provider->database->query("UPDATE `" . $provider->database->table . "` SET `" . consts::$fields_active . "` = '" . consts::$value_deactivate . "', `modified` = current_timestamp() WHERE `id` = '" . $provider->variables->id . "'");
    $provider->message->message($provider->language->translate("massage_deactivate"), true);
    $provider->route->redirect($provider->route->index($provider->variables->page));
}
if ($provider->variables->sub_action == consts::$action_activate)
{
    $provider->database->query("UPDATE `" . $provider->database->table . "` SET `" . consts::$fields_active . "` = '" . consts::$value_activate . "', `modified` = current_timestamp() WHERE `id` = '" . $provider->variables->sub_id . "'");
    $provider->message->message($provider->language->translate("massage_activate"), true);
    $provider->route->redirect($provider->route->child($provider->variables->page, $provider->variables->id));
}
if ($provider->variables->sub_action == consts::$action_deactivate)
{
    $provider->database->query("UPDATE `" . $provider->database->table . "` SET `" . consts::$fields_active . "` = '" . consts::$value_deactivate . "', `modified` = current_timestamp() WHERE `id` = '" . $provider->variables->sub_id . "'");
    $provider->message->message($provider->language->translate("massage_deactivate"), true);
    $provider->route->redirect($provider->route->child($provider->variables->page, $provider->variables->id));
}
?>