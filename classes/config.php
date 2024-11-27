<?php

class config
{

    private string $path = "";
    
    private string $app_path = "";

    private string $app_admin_path = "";

    private string $app_url = "";

    private string $app_salt = "";

    private bool $error_reporting = false;

    private string $db_host = "";

    private string $db_port = "";

    private string $db_database = "";

    private string $db_username = "";

    private string $db_password = "";

    private string $db_prefx = "";

    private string $default_language = "";

    private string $default_language_admin = "";

    public function __construct(string $path)
    {
        $this->path = $path;
        
        $env_path = $this->get_env_path();
        
        if (! file_exists($env_path)) {
            die("NO CONFIG FILE");
        }

        if ($file = fopen($env_path, "r")) {
            while (! feof($file)) {
                $line = fgets($file);

                if (! empty($line)) {
                    $explode = explode("=", $line);

                    if (! empty($explode[1])) {

                        $this->set_variable("APP_PATH", $this->app_path, $explode[0], $explode[1]);
                        $this->set_variable("APP_ADMIN_PATH", $this->app_admin_path, $explode[0], $explode[1]);
                        $this->set_variable("APP_URL", $this->app_url, $explode[0], $explode[1]);
                        $this->set_variable("APP_SALT", $this->app_salt, $explode[0], $explode[1]);
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
    
    private function get_env_path()
    {
        return $this->path  . ".env";
    }

    private function set_variable(string $key, &$variable, string $explode_key, string $explode_variable)
    {
        if ($key == $explode_key) {
            $variable = preg_replace('/\s+/', '', $explode_variable);
        }
    }

    public function path()
    {
        return $this->path;
    }
    
    public function app_path()
    {
        return $this->app_path;
    }

    public function app_admin_path()
    {
        return $this->app_admin_path;
    }

    public function app_url()
    {
        return $this->app_url;
    }

    public function app_salt()
    {
        return $this->app_salt;
    }

    public function error_reporting()
    {
        return $this->error_reporting;
    }

    public function db_host()
    {
        return $this->db_host;
    }

    public function db_port()
    {
        return $this->db_port;
    }

    public function db_database()
    {
        return $this->db_database;
    }

    public function db_username()
    {
        return $this->db_username;
    }

    public function db_password()
    {
        return $this->db_password;
    }

    public function db_prefx()
    {
        return $this->db_prefx;
    }

    public function default_language()
    {
        return $this->default_language;
    }

    public function default_language_admin()
    {
        return $this->default_language_admin;
    }
}

?>