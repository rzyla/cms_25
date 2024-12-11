<?php 

class breadcrumb
{
    private array $items = [];
    
    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }
    }

    public function add(?string $url, string $value)
    {
        $this->items[] = new breadcrumb_item($url, $value);
    }
}

class breadcrumb_item
{
    private ?string $url = "";
    private string $value = "";
    
    function __construct(?string $url, string $value)
    {
        $this->url = $url;
        $this->value = $value;
    }
    
    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }
    }
}

?>