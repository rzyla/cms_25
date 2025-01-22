<?php
if (array_key_exists(consts::$server_request_method, $_SERVER) && strtoupper($_SERVER[consts::$server_request_method]) == strtoupper(consts::$request_post))
{
    if (array_key_exists("login", $_POST) && !empty($_POST["login"]) && array_key_exists("password", $_POST) && !empty($_POST["password"]))
    {
        $user = $provider->database->item("SELECT `id`, `password`, `active` FROM " . consts::$table_users . " WHERE `login` = '" . $_POST["login"] . "'");

        if (array_key_exists("id", $user) && !empty($user["id"]) && array_key_exists("password", $user) && !empty($user["password"]))
        {
            if($user['active'] != consts::$value_activate)
            {
                $provider->message->message($provider->language->translate("massage_login_active_error"), false);
                $provider->route->redirect($provider->route->login());
            }
            
            if ($provider->variables->password($_POST["password"]) == $user["password"])
            {
                $_SESSION[consts::$value_session_admin] = $user["id"];
                $provider->route->redirect($provider->route->index(consts::$page_dashboard));
            }
        }
    }

    $provider->message->message($provider->language->translate("massage_login_error"), false);
    $provider->route->redirect($provider->route->login());
}
else
{
    $provider->variables->init_view(null, consts::$page_login, consts::$action_login, consts::$layout_empty);
}

?>