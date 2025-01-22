<?php 

function html_token(string $token) : string
{
    return '<input type="hidden" name="' . consts::$request_token . '" value="' . $token .'" />';
}

?>