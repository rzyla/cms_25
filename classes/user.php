<?php 

class user
{
    private string $name;
    
    function __construct()
    {
        $this->init();
    }
    
    private function init()
    {
        $this->name = "Radosław Żyła";
    }
    
    public function name() : string 
    {
        return $this->name;
    }
}

?>