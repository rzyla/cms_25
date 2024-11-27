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
    
    public function add()
    {
        $this->add = true;
    }
    
    public function list()
    {
        $this->list = true;
    }
    
    public function showAdd()
    {
        return $this->add;
    }
    
    public function showList()
    {
        return $this->list;
    }
}

?>