<?php

class buttons
{

    private string $add = "";

    private string $list = "";
    
    private string $back = "";

    private bool $position = false;

    private array $buttons = [ ];

    private route $route;

    private variables $variables;

    function __construct(route $route, variables $variables)
    {
        $this->route = $route;
        $this->variables = $variables;
    }

    public function __get($key)
    {
        if (isset($this->$key))
        {
            return $this->$key;
        }
    }

    public function add(?int $id = 0)
    {
        $this->add = $this->route->add($this->variables->page, $id);
    }

    public function list(?int $id = 0)
    {
        $this->list = empty($id) ? $this->route->index($this->variables->page) : $this->route->child($this->variables->page, $id);
    }
    
    public function back(string $back)
    {
        $this->back = $back;
    }

    public function position()
    {
        $this->position = true;
    }

    public function button()
    {
        $this->buttons[] = true;
    }

    public function child()
    {
        $this->child = true;
    }
}

class button_item
{

    private ?string $url = "";

    private string $value = "";

    private string $class = "";

    function __construct(?string $url, string $value, string $class)
    {
        $this->url = $url;
        $this->value = $value;
        $this->class = $class;
    }

    public function __get($key)
    {
        if (isset($this->$key))
        {
            return $this->$key;
        }
    }
}

?>