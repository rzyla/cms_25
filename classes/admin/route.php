<?php

class route
{
    private string $path = "";
    
    function __construct(string $path)
    {
        $this->path = $path; 
    }
    
    public function route(string $path) : string
    {
        return $this->path . $path;
    }
    
    public function index(string $page) : string
    {
        return sprintf(consts::$path_list, $this->path, $page);
    }
    
    public function child(string $page, $id) : string
    {
        return sprintf(consts::$path_child, $this->path, $page, $id);
    }
    
    public function add(string $page, ?int $id = 0) : string
    {
        return sprintf(consts::$path_add, $this->path, $page, $id);
    }
    
    public function insert(string $page, ?int $id = 0) : string
    {
        return sprintf(consts::$path_insert, $this->path, $page, $id);
    }
    
    public function edit(string $page, int $id/*, ?int $parent_id = null*/) : string
    {
        //return !empty($parent_id) ? sprintf(consts::$path_child_edit, $this->path, $page, $parent_id, $id) : sprintf(consts::$path_edit, $this->path, $page, $id);
        return sprintf(consts::$path_edit, $this->path, $page, $id);
    }
    
    public function update(string $page, int $id) : string
    {
        return sprintf(consts::$path_update, $this->path, $page, $id);
    }
    
    public function save(string $page, int $id) : string
    {
        return sprintf(consts::$path_save, $this->path, $page, $id);
    }
    
    public function delete(string $page, int $id/*, ?int $parent_id = null*/) : string
    {
        //return !empty($parent_id) ? sprintf(consts::$path_child_delete, $this->path, $page, $parent_id, $id) :  sprintf(consts::$path_delete, $this->path, $page, $id);
        return sprintf(consts::$path_delete, $this->path, $page, $id);
    }
    
    public function activate(string $page, int $id, ?int $parent_id = null) : string
    {
        return !empty($parent_id) ? sprintf(consts::$path_child_activate, $this->path, $page, $parent_id, $id) : sprintf(consts::$path_activate, $this->path, $page, $id);
    }
    
    public function deactivate(string $page, int $id, ?int $parent_id = null) : string
    {
        return !empty($parent_id) ? sprintf(consts::$path_child_deactivate, $this->path, $page, $parent_id, $id) : sprintf(consts::$path_deactivate, $this->path, $page, $id);
    }
    
    public function action(string $path, string $page, int $id) : string
    {
        return sprintf($path, $this->path, $page, $id);
    }
    
    public function position(string $page, ?int $parent = null) : string
    {
        return !empty($parent) ? sprintf(consts::$path_child_position, $this->path, $page, $parent) : sprintf(consts::$path_position, $this->path, $page);
    }    
    
    public function login() : string
    {
        return sprintf(consts::$path_login, $this->path);
    }
    
    public function logout() : string
    {
        return sprintf(consts::$path_logout, $this->path);
    }
    
    public function manage(string $page, int $id) : string
    {
        return sprintf(consts::$path_manage, $this->path, $page, $id);
    }
    
    public function manage_submit(string $page, int $id) : string
    {
        return sprintf(consts::$path_manage_submit, $this->path, $page, $id);
    }
    
    public function manage_position(string $page, int $id) : string
    {
        return sprintf(consts::$path_manage_position, $this->path, $page, $id);
    }
    
    public function manage_delete(string $page, int $id, int $sub_id) : string
    {
        return sprintf(consts::$path_manage_delete, $this->path, $page, $id, $sub_id);
    }
    
    public function module(string $module) : string
    {
        return sprintf(consts::$path_module, $this->path, $module);
    }
    
    public function content(string $id, string $content_id = null, string $action = null, string $subcontent_id = null, string $subaction = null) : string
    {
        if($content_id == null)
        {
            return sprintf(consts::$path_content, $this->path, $id);
        }
        
        if($subcontent_id == null)
        {
            return sprintf(consts::$path_content_content_id, $this->path, $id, $content_id, $action);
        }
        
        return sprintf(consts::$path_content_content_id_subcontent_id, $this->path, $id, $content_id, $action, $subcontent_id, $subaction);
    }
    
    public function partial(string $content_id, string $action = null, string $subcontent_id = null, string $subaction = null) : string
    {
        if($subcontent_id == null)
        {
            return sprintf(consts::$path_partial, $this->path, $content_id, $action);
        }
        
        return sprintf(consts::$path_partial_subcontent_id, $this->path, $content_id, $action, $subcontent_id, $subaction);
    }
    
    public function redirect(string $path = "")
    {
        header(sprintf(consts::$path_redirect, $path));
        exit();
    }
}

?>