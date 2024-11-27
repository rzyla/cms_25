<?php

class route
{
    private string $path = "";
    
    function __construct(string $path)
    {
        $this->path = $path; 
    }
    
    public function route(string $path)
    {
        return $this->path . $path;
    }
    
    public function list(string $page)
    {
        return $this->path . $page;
    }
    
    public function add(string $page)
    {
        return sprintf(consts::$path_add, $this->path, $page);
    }
    
    public function edit(string $page, int $id)
    {
        return sprintf(consts::$path_edit, $this->path, $page, $id);
    }
    
    public function delete(string $page, int $id)
    {
        return sprintf(consts::$path_delete, $this->path, $page, $id);
    }
    
    public function redirect(string $path = "")
    {
        header(sprintf(consts::$path_redirect, $this->path, $path));
        exit();
    }
}

?>