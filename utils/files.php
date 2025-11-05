<?php 

function files_resize(string $source_path, string $target_path, int $target_width, int $target_height): bool
{
    if (empty($source_path) || !file_exists($source_path))
    {
        return false;
    }
    
    $file_extension = files_file_extension($source_path);
    
    if (empty($file_extension))
    {
        return false;
    }
    
    list ($source_width, $source_height) = getimagesize($source_path);
    
    $source_thumb = $file_extension == 'jpg' || $file_extension == "jpeg" ? imagecreatefromjpeg($source_path) : null;
    $source_thumb = $file_extension == 'gif' ? imagecreatefromgif($source_path) : $source_thumb;
    $source_thumb = $file_extension == 'png' ? imagecreatefrompng($source_path) : $source_thumb;
    
    $target_thumb = imagecreatetruecolor($target_width, $target_height);
    imagefilledrectangle($target_thumb, 0, 0, $target_width, $target_height, imagecolorallocate($target_thumb, 255, 255, 255));
    imagealphablending($target_thumb, true);
    imagecopyresampled($target_thumb, $source_thumb, 0, 0, 0, 0, $target_width, $target_height, $source_width, $source_height);
    imagejpeg($target_thumb, $target_path, 100);
    imagedestroy($source_thumb);
    imagedestroy($target_thumb);
    
    return true;
}

function files_file_extension($path)
{
    $path_info = pathinfo($path);
    
    if (array_key_exists('extension', $path_info) && !empty($path_info['extension']))
    {
        return $path_info['extension'];
    }
    
    return "";
}

?>