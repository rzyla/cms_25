<?php 

function security_create_password(string $salt, string $password) : string
{
    return md5($salt . $password . $salt);
}

?>