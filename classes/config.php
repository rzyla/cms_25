<?php

class config
{

    private string $path = "";

    private string $app_path = "";

    private string $app_admin_path = "";

    private string $app_url = "";

    private string $app_salt = "";

    private string $app_token_time = "";

    private bool $error_reporting = false;

    private string $db_host = "";

    private string $db_port = "";

    private string $db_database = "";

    private string $db_username = "";

    private string $db_password = "";

    private string $db_prefx = "";

    private string $default_language = "";

    private string $default_language_admin = "";

    private string $path_upload = "";
    
    private string $path_upload_images = "";

    private string $path_images = "";

    private string $path_document_root = "";

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->path_document_root = $_SERVER['DOCUMENT_ROOT'];
        $this->path_upload = $this->path_document_root . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'upload';
        $this->path_upload_images = $this->path_document_root . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images';
        $this->path_images = DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images';

        $env_path = $this->get_env_path();

        if (!file_exists($env_path))
        {
            die("NO CONFIG FILE");
        }

        if ($file = fopen($env_path, "r"))
        {
            while (!feof($file))
            {
                $line = fgets($file);

                if (!empty($line))
                {
                    $explode = explode("=", $line);

                    if (!empty($explode[1]))
                    {

                        $this->set_variable("APP_PATH", $this->app_path, $explode[0], $explode[1]);
                        $this->set_variable("APP_ADMIN_PATH", $this->app_admin_path, $explode[0], $explode[1]);
                        $this->set_variable("APP_URL", $this->app_url, $explode[0], $explode[1]);
                        $this->set_variable("APP_SALT", $this->app_salt, $explode[0], $explode[1]);
                        $this->set_variable("APP_TOKEN_TIME", $this->app_token_time, $explode[0], $explode[1]);
                        $this->set_variable("ERROR_REPORTING", $this->error_reporting, $explode[0], $explode[1]);
                        $this->set_variable("DB_HOST", $this->db_host, $explode[0], $explode[1]);
                        $this->set_variable("DB_PORT", $this->db_port, $explode[0], $explode[1]);
                        $this->set_variable("DB_DATABASE", $this->db_database, $explode[0], $explode[1]);
                        $this->set_variable("DB_USERNAME", $this->db_username, $explode[0], $explode[1]);
                        $this->set_variable("DB_PASSWORD", $this->db_password, $explode[0], $explode[1]);
                        $this->set_variable("DB_PREFIX", $this->db_prefx, $explode[0], $explode[1]);
                        $this->set_variable("DB_PREFIX", $this->default_language, $explode[0], $explode[1]);
                        $this->set_variable("DEFAULT_LANGUAGE_ADMIN", $this->default_language_admin, $explode[0], $explode[1]);
                    }
                }
            }

            fclose($file);
        }
    }

    public function __get($key)
    {
        if (isset($this->$key))
        {
            return $this->$key;
        }
    }

    private function get_env_path()
    {
        return $this->path . ".env";
    }

    private function set_variable(string $key, &$variable, string $explode_key, string $explode_variable)
    {
        if ($key == $explode_key)
        {
            $variable = preg_replace('/\s+/', '', $explode_variable);
        }
    }
}

?>