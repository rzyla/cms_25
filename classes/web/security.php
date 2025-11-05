<?php

class security
{

    private config $config;

    private route $route;

    private user $user;

    private variables $variables;

    private message $message;

    private language $language;

    private string $token = "";

    function __construct(config $config, route $route, user $user, variables $variables, message $message, language $language)
    {
        $this->config = $config;
        $this->route = $route;
        $this->user = $user;
        $this->variables = $variables;
        $this->message = $message;
        $this->language = $language;
        //$this->checkLogged();
        $this->checkReferer();
        $this->checkToken();
        $this->token = $this->getToken();
    }

    public function __get($key)
    {
        if (isset($this->$key) && !is_object($this->$key))
        {
            return $this->$key;
        }
    }

    public function checkReferer()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) != strtoupper(consts::$request_get))
        {
            if (security_get_referer(consts::$server_http_referer) != $this->config->app_url)
            {
                $this->message->message($this->language->translate("massage_security_refferer_error"), false);
                $this->route->redirect($this->route->index());
            }
        }
    }


    public function checkToken()
    {
        if (array_key_exists(consts::$server_request_method, $_SERVER) && strtoupper($_SERVER[consts::$server_request_method]) != strtoupper(consts::$request_get))
        {
            if (empty($_POST[consts::$request_token]))
            {
                $this->message->message($this->language->translate("massage_security_token_error"), false);
                $this->route->redirect($this->route->logout());
            }

            $check = false;

            for ($i = 0; $i <= $this->config->app_token_time; $i++)
            {
                if (array_key_exists(consts::$request_token, $_POST) && $_POST[consts::$request_token] == $this->getToken($i))
                {
                    $check = true;
                }
            }

            if ($check == false)
            {
                $this->message->message($this->language->translate("massage_security_token_error"), false);
                $this->route->redirect($this->route->logout());
            }
        }
    }

    public function getToken(int $minutes = 0): string
    {
        return security_create_token(consts::$app_request_token, $this->config->app_salt, $minutes);
    }
}

?>