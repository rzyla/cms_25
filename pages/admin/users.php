<?php 

if($app['action'] == "index")
{
    $app['buttons'] = new buttons(true, true);
    
    
    $list = mysqli_list("SELECT * FROM " . mysqli_prefix("users") . " ORDER BY login");
}

if($app['action'] == "delete")
{
    
}

if($app['action'] == "add" || $app['action'] == "edit")
{
    
}

?>