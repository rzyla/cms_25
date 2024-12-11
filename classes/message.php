<?php 

class message
{
    private bool $success = false;
    private string $message = "";
    
    function __construct()
    {
        $this->success = !empty($_SESSION['message']['success']) ? $_SESSION['message']['success'] : "";
        $this->message = !empty($_SESSION['message']['message']) ? $_SESSION['message']['message'] : "";
        
        unset($_SESSION['message']);
    }
    
    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }
    }
    
    public function message(string $message, bool $success)
    {
        $this->success = $success;
        $this->message = $message;
        $_SESSION['message']['success'] = $success;
        $_SESSION['message']['message'] = $message;
    }
}

?>