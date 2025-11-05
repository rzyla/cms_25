<?php

function array_key_value(array $list = [ ])
{
    $array = [ ];

    foreach($list as $item)
    {
        $array[$item['key']] = $item['value'];
    }
    
    return $array;
}

?>