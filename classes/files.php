<?php

class files
{

    private config $config;

    function __construct(config $config)
    {
        $this->config = $config;
    }

    public function path(array $array = [ ]): string
    {
        return implode(DIRECTORY_SEPARATOR, $array);
    }

    public function name($path): string
    {
        $file_extension = files_file_extension($path);

        if (!empty($file_extension))
        {
            return md5(uniqid() . string_random(25)) . '.' . $file_extension;
        }

        return "";
    }

    public function upload(string $path_from, string $path_to): bool
    {
        if (file_exists($path_from) && !file_exists($path_to))
        {
            return move_uploaded_file($path_from, $path_to);
        }

        return false;
    }

    public function delete(string $path)
    {
        if (file_exists($path) && is_file($path))
        {
            unlink($path);
        }
    }
}

?>