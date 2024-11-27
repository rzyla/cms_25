<?php 

class bootstrap
{
    function __construct()
    {
        if(!empty($_GET[consts::$url]))
        {
            $explode = explode(consts::$slash, $_GET[consts::$url]);
            
            if($explode[0] == consts::$admin)
            {
                require_once 'bootstrap/admin.php';
            }
            else 
            {
                require_once 'bootstrap/web.php';
            }
        }
    }
}

?>