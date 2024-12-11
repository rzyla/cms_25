<?php 

class buttons
{
    private bool $add = false;
    private bool $list = false;
    
    function __construct(bool $add = false, bool $list = false)
    {
        $this->add = $add;
        $this->list = $list;
    }
    
    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }
    }
    
    public function add()
    {
        $this->add = true;
    }
    
    public function list()
    {
        $this->list = true;
    }
}

?>