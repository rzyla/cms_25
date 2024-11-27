<?php

class variables
{

    private array $get;

    private array $post;

    private string $page = "";

    private string $action = "";

    private string $view = "";

    private string $provider = "";

    function __construct(string $provider)
    {
        $this->provider = $provider;
        $this->init($provider);
    }

    private function init()
    {
        $explode = explode(consts::$slash, $_GET[consts::$url]);

        if ($explode[0] == consts::$admin && $this->provider == consts::$admin) {
            array_shift($explode);
        }

        $this->page = ! empty($explode[0]) ? $explode[0] : consts::$dashboard;
        $this->action = ! empty($explode[1]) ? $explode[1] : consts::$index;

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

    public function check_view()
    {
        $this->view = sprintf(consts::$path_view, $this->provider, $this->page);
        if (! file_exists($this->view)) {
            $this->page = consts::$error_page;
            $this->view = sprintf(consts::$path_view, $this->provider, $error_page);
        }
    }

    private function init_get()
    {}

    private function init_post()
    {}

    public function get(): array
    {
        return $this->get();
    }

    public function post(): array
    {
        return $this->post();
    }

    public function page(): string
    {
        return $this->page;
    }

    public function action(): string
    {
        return $this->action;
    }

    public function view(): string
    {
        return $this->view;
    }

    public function provider(): string
    {
        return $this->provider;
    }
}

?>