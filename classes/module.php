<?php

class module
{

    private int $id = 0;

    private string $file = "";

    private string $view = "";

    private array $entity = [ ];
    
    private int $content_id = 0;

    private string $name = "";

    function __construct(int $id, string $file, string $view, array $entity = [], int $content_id = 0,  string $name = "")
    {
        $this->id = $id;
        $this->file = $file;
        $this->view = $view;
        $this->entity = $entity;
        $this->content_id = $content_id;
        $this->name = $name;
    }

    public function __get($key)
    {
        if (isset($this->$key))
        {
            return $this->$key;
        }
    }

    public function data(string $key)
    {
        if (array_key_exists($key, $this->entity))
        {
            return $this->entity[$key];
        }

        return null;
    }
}

?>