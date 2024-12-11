<?php 

class user
{
    private int $acl;
    private int $id;
    private string $name;
    
    function __construct()
    {
        $this->init();
    }
    
    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }
    }
    
    private function init()
    {
        $this->acl = 9;
        $this->id = 1;
        $this->name = "Radosław Żyła";
    }
}

?>