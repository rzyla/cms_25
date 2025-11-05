<?php
require_once 'config.php';
require_once '../../utils/string.php';
require_once '../../utils/files.php';

try
{
    $filename = explode(".", $_FILES[UPLOAD_IMAGES_FORM_FIELD_NAME]["name"]);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $tmpName = $_FILES[UPLOAD_IMAGES_FORM_FIELD_NAME]["tmp_name"];
    $mimeType = finfo_file($finfo, $tmpName);
    $extension = end($filename);

    $allowedExts = array (
        "gif",
        "jpeg",
        "jpg",
        "png",
        "svg",
        "blob"
    );

    $allowedMimeTypes = array (
        "image/gif",
        "image/jpeg",
        "image/pjpeg",
        "image/x-png",
        "image/png",
        "image/svg+xml"
    );

    if (!in_array(strtolower($mimeType), $allowedMimeTypes) || !in_array(strtolower($extension), $allowedExts))
    {
        throw new \Exception("File does not meet the validation.");
    }

    $name = sha1(string_random(25) . microtime()) . "." . $extension;
    $path_images = dirname(__FILE__) . UPLOAD_IMAGES_DIR . $name;
    $path_thumbs = dirname(__FILE__) . UPLOAD_IMAGES_THUMBS_DIR . $name;
    $protocol = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off" ? "https://" : "http://";

    move_uploaded_file($tmpName, $path_images);
    files_resize($path_images, $path_thumbs, 200, 200);

    $response = new \StdClass();
    $response->link = IMAGES_DIR . $name;

    echo stripslashes(json_encode($response));
}
catch (Exception $e)
{
    echo $e->getMessage();
    http_response_code(404);
}
?>