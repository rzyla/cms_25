<?php
require_once 'config.php';

try
{

    $images = [ ];

    $files = array_diff(scandir(SCAN_IMAGES_DIR), array (
        '.',
        '..'
    ));
    
    foreach($files as $file)
    {
        $image = new \StdClass();
        $image->url = IMAGES_DIR . $file;
        $image->thumb = THUMBS_DIR . $file;
        
        $images[] = $image;
    }

    echo stripslashes(json_encode($images));
}
catch (Exception $e)
{
    echo $e->getMessage();
    http_response_code(404);
}
?>