<?php
if ($provider->variables->action == consts::$action_delete) {
    $provider->database->query("DELETE FROM `" . $provider->database->table . "` WHERE `id` = '" . $provider->variables->id . "'");
    $provider->message->message($provider->language->translate("massage_deleted"), true);
    $provider->route->redirect($provider->route->index($provider->variables->page));
}
if ($provider->variables->sub_action == consts::$action_delete)
{
    $provider->database->query("DELETE FROM `" . $provider->database->table . "` WHERE `id` = '" . $provider->variables->sub_id . "'");
    $provider->message->message($provider->language->translate("massage_deleted"), true);
    $provider->route->redirect($provider->route->child($provider->variables->page, $provider->variables->id));
}

?>