<?php

function menu_revert_string(array $menu_revert)
{
    $menu = [ ];

    foreach($menu_revert as $item)
    {
        $menu[] = $item['name'];
    }
    
    return implode(' > ', $menu);
}

?>