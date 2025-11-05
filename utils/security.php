<?php 

function security_create_password(string $salt, string $password) : string
{
    return md5($salt . $password . $salt);
}

function security_create_token(string $mask, string $salt, int $minutes = 0): string
{
    return md5(sprintf($mask, $salt, date("Y-m-d H:i", mktime(date("H"), date("i") - $minutes, date("s"), date("m"), date("d"), date("Y"))), $salt));
}

function security_get_referer(string $variable): ?string
{
    if (array_key_exists($variable, $_SERVER))
    {
        $explode = explode('/', $_SERVER[$variable]);
        
        return $explode[2];
    }
    
    return null;
}

?>