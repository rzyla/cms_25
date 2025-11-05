<?php

class variables
{

    private array $get;

    private array $post;

    private ?int $id;

    private ?int $sub_id;

    private ?int $content_id;

    private ?string $content_action = "";

    private string $page = "";

    private string $action = "";

    private ?string $sub_action = "";

    private string $view = "";

    private string $provider = "";

    private string $layout = "";

    private string $module = "";

    private config $config;

    private array $data = [ ];

    private array $errors = [ ];

    function __construct(config $config, string $provider)
    {
        $this->provider = $provider;
        $this->config = $config;
        $this->init($provider);
    }

    public function __get($key)
    {
        if (isset($this->$key) && !is_object($this->$key))
        {
            return $this->$key;
        }
    }

    private function init()
    {
        $url = !empty($_GET[consts::$url]) ? $_GET[consts::$url] : "";
        
        $explode = explode(consts::$slash, $url);

        if ($explode[0] == consts::$provider_admin && $this->provider == consts::$provider_admin)
        {
            array_shift($explode);
        }

        $this->page = !empty($explode[0]) ? $explode[0] : consts::$page_dashboard;

        if ($this->page == consts::$page_module)
        {
            $this->module = $explode[1];
            $this->action = !empty($explode[2]) ? $explode[2] : consts::$action_index;
            $this->id = !empty($explode[3]) ? $explode[3] : null;
            $this->sub_action = !empty($explode[4]) ? $explode[4] : consts::$action_index;
            $this->sub_id = !empty($explode[5]) ? $explode[5] : null;
        }
        else 
            if ($this->page == consts::$page_content)
            {
                $this->action = empty($_POST) ? consts::$action_edit : consts::$action_update;
                $this->id = !empty($explode[1]) ? $explode[1] : null;
                $this->content_id = !empty($explode[2]) ? $explode[2] : null;
                $this->content_action = !empty($explode[3]) ? $explode[3] : consts::$action_index;
                $this->sub_id = !empty($explode[4]) ? $explode[4] : null;
                $this->sub_action = !empty($explode[5]) ? $explode[5] : null;
            }
            else if ($this->page == consts::$page_partial)
            {
                $this->action = empty($_POST) ? consts::$action_edit : consts::$action_update;
                $this->content_id = !empty($explode[1]) ? $explode[1] : null;
                $this->content_action = !empty($explode[2]) ? $explode[2] : consts::$action_index;
                $this->sub_id = !empty($explode[3]) ? $explode[3] : null;
                $this->sub_action = !empty($explode[4]) ? $explode[4] : null;
            }
            else
            {
                $this->action = !empty($explode[1]) ? $explode[1] : consts::$action_index;
                $this->id = !empty($explode[2]) ? $explode[2] : null;
                $this->sub_action = !empty($explode[3]) ? $explode[3] : consts::$action_index;
                $this->sub_id = !empty($explode[4]) ? $explode[4] : null;
            }

        $this->layout = consts::$layout_default;

        $this->set_view();
        $this->set_get();
        $this->set_post();
    }

    public function include_page($provider)
    {
        // $provider is used by include page
        $path = sprintf(consts::$path_page, $this->provider, $this->page);

        if (file_exists($path))
        {
            include ($path);
        }
    }

    public function set_action(string $action = "")
    {
        if (!empty($action))
        {
            $this->action = $action;
            $this->set_view();
        }
    }

    public function set_view(string $provider = null, string $page = null, string $action = null, string $layout = null, bool $module = false)
    {
        $provider = empty($provider) ? $this->provider : $provider;
        $page = empty($page) ? $this->page : $page;
        $action = empty($action) ? $this->action : $action;

        $this->view = $module == false ? sprintf(consts::$path_view, $provider, $page, $action) : sprintf(consts::$path_view_module, $provider, $page, $action);
        $this->layout = empty($layout) ? $this->layout : $layout;
    }

    public function init_module_view()
    {
        $this->view = sprintf(consts::$path_module_view, $this->provider, $this->module);
    }

    private function init_layout()
    {}

    public function check_view(layout &$layout)
    {
        if (!file_exists($this->view))
        {
            $this->page = consts::$error_page;
            $this->action = consts::$error_404;
            $this->view = sprintf(consts::$path_view, $this->provider, consts::$error_page, consts::$error_404);
        }
    }

    private function set_get()
    {}

    private function set_post()
    {
        $this->post = $_POST;
    }

    public function get(): array
    {
        return $this->get();
    }

    public function post(string $key)
    {
        if (isset($this->post[$key]))
        {
            return $this->post[$key];
        }
    }
    
    public function post_module(string $module_key, string $key)
    {
        if (isset($this->post['content'][$module_key][$key]))
        {
            return $this->post['content'][$module_key][$key];
        }
    }

    public function error(string $key, $value)
    {
        $this->errors[$key] = $value;
    }

    public function password(string $password): string
    {
        return security_create_password($this->config->app_salt, $password);
    }

    public function action(string $action)
    {
        $this->action = $action;
    }

    public function data(string $key, array $array)
    {
        $this->data[$key] = $array;
    }

    public function html_value(string $key, string $field)
    {
        if (array_key_exists($field, $this->post))
        {
            return $this->post[$field];
        }

        return array_key_exists($key, $this->data) ? array_key_exists($field, $this->data[$key]) ? $this->data[$key][$field] : null : null;
    }

    public function diff_by_key(array &$dictionary, $keys)
    {
        foreach($keys as $key)
        {
            unset($dictionary[$key]);
        }
    }

    public function get_value(string $key, ?array $array = [ ])
    {
        return array_key_exists($key, $array) ? $array[$key] : null;
    }
    
    //echo '<pre>' . print_r(get_defined_vars(), true) . '</pre>';
}

?>