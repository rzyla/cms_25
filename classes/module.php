<?php

class module
{

    private int $id = 0;

    private string $file = "";

    private string $view = "";

    private array $entity = [ ];

    function __construct(int $id, string $file, string $view, array $entity)
    {
        $this->id = $id;
        $this->file = $file;
        $this->view =  $view;
        $this->entity = $entity;
    }
    
    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }
    }
    
    public function data(string $key)
    {
        if(array_key_exists($key, $this->entity))
        {
            return $this->entity[$key];
        }
        
        return null;
    }
}

?>