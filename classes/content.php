<?php

class content
{

    private string $form_content_url = "";

    private string $form_module_url = "";
    
    private array $entity = [];

    public function __get($key)
    {
        if (isset($this->$key))
        {
            return $this->$key;
        }
    }
    
    public function entity(array $entity = [])
    {
        $this->entity = $entity;
    }
    
    public function formContent(string $url = "")
    {
        $this->form_content_url = $url;
    }
    
    public function formModule(string $url = "")
    {
        $this->form_module_url = $url;
    }
}

?>