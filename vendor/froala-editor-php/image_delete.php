<?php
require_once 'config.php';

try
{
    if (array_key_exists('src', $_POST))
    {
        $info = pathinfo($_POST['src']);

        unlink(SCAN_IMAGES_DIR . $info['basename']);
        unlink(SCAN_IMAGES_THUMBS_DIR . $info['basename']);
    }
}
catch (Exception $e)
{
    echo $e->getMessage();
    http_response_code(404);
}
?>