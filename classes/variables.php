<?php

class variables
{

    private array $get;

    private array $post;

    private ?int $id;

    private string $page = "";

    private string $action = "";

    private string $view = "";

    private string $provider = "";
    
    private config $config;
    
    private array $data = [];

    function __construct(config $config, string $provider)
    {
        $this->provider = $provider;
        $this->config = $config;
        $this->init($provider);
    }

    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }
    }

    private function init()
    {
        $explode = explode(consts::$slash, $_GET[consts::$url]);

        if ($explode[0] == consts::$provider_admin && $this->provider == consts::$provider_admin) {
            array_shift($explode);
        }

        $this->page = ! empty($explode[0]) ? $explode[0] : consts::$page_dashboard;
        $this->action = ! empty($explode[1]) ? $explode[1] : consts::$action_index;
        $this->id = ! empty($explode[2]) ? $explode[2] : null;

        $this->init_get();
        $this->init_post();
    }

    public function include_page($provider)
    {
        $path = sprintf(consts::$path_page, $this->provider, $this->page);

        if (file_exists($path)) {
            include ($path);
        }
    }

    public function check_view(layout &$layout)
    {
        $this->view = sprintf(consts::$path_view, $this->provider, $this->page, $this->action);

        if (! file_exists($this->view)) {
            $this->page = consts::$error_page;
            $this->action = consts::$error_404;
            $this->view = sprintf(consts::$path_view, $this->provider, consts::$error_page, consts::$error_404);
        }
    }

    private function init_get()
    {}

    private function init_post()
    {
        $this->post = $_POST;
    }

    public function get(): array
    {
        return $this->get();
    }

    public function post(string $key)
    {
        if(isset($this->post[$key]))
        {
            return $this->post[$key];
        }
    }
    
    public function password(string $password) : string
    {
        return(md5($this->config->app_salt . $password));
    }
    
    public function action(string $action)
    {
        $this->action = $action;
    }

    public function data(array $data)
    {
        $this->data = $data;
    }
}

?>