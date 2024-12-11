<?php 

class layout
{
    private breadcrumb $breadcrumb;
    private string $title = "";
    
    function __construct()
    {
        $this->breadcrumb = new breadcrumb();
    }
    
    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }
    }
    
    public function title(string $title)
    {
        $this->title = $title;
    }
}

?>