<?php 

class language
{
    private string $current = "";
    private array $translate = [];
    
    function __construct(string $default, string $provider)
    {
        $this->current = $default;
        $this->provider = $provider;
        $this->translate = require_once sprintf(consts::$path_language, $this->current, $this->provider);
    }
    
    public function current()
    {
        return $this->current;
    }
    
    public function translate(string $key, array $params = []): string
    {
        return sprintf($this->translate[$key], $params);
    }
}

?>