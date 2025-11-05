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
        $this->ping();
        $this->checkLogged();
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

    public function checkLogged()
    {        
        if (($this->user?->acl == null || $this->user?->acl == 0) && $this->variables->page != consts::$page_login)
        {
            $this->route->redirect($this->route->login());
        }
    }

    public function checkReferer()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) != strtoupper(consts::$request_get))
        {
            if (security_get_referer(consts::$server_http_referer) != $this->config->app_url)
            {
                $this->message->message($this->language->translate("massage_security_refferer_error"), false);
                $this->route->redirect($this->route->logout());
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

    public function acl(int $acl): bool
    {
        return $this->user->acl >= $acl;
    }

    public function accessToPage(int $acl, string $page)
    {
        if (!$this->acl($acl))
        {
            $this->denyAccessRedirect($page);
        }
    }

    public function denyAccessToItem(string $page, array $items = [ ], array $find = [ ])
    {
        $compare = array_intersect($items, $find);
        
        if (!empty($compare))
        {
            $this->denyAccessRedirect($page);
        }
    }

    public function denyAccessRedirect(string $page)
    {
        $this->message->message($this->language->translate("massage_security_access_error"), false);
        $this->route->redirect($this->route->index($page));
    }

    public function denyAccessActions(string $action): bool
    {
        $items = [
            consts::$action_insert,
            consts::$action_update,
            consts::$action_delete,
            consts::$action_activate,
            consts::$action_deactivate
        ];
        
        $compare = array_intersect($items, [$action]);
        
        return !empty($compare);
    }
    
    private function ping()
    {
        if (!isset($_COOKIE[consts::$ping_cms])) 
        {
            $ch = curl_init("http://cms.arteh.pl/ping.php");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
            
            setcookie(consts::$ping_cms, time(), time() + 86400, "/");
        }
    }
}

?>