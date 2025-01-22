<?php 

ini_set('display_errors', 1);
ini_set('error_reporting', 1);

error_reporting(E_ALL);

$path = "../../";

require_once $path . 'utils/security.php';
require_once $path . 'classes/config.php';
require_once $path . 'classes/database.php';

$config = new config($path);
$database = new database($config);

$database->query("INSERT INTO users (`login`, `password`, `name`, `acl`, `active`) VALUES ('test', '" . security_create_password($config->app_salt, "test") . "', 'test', '9', '1')");

echo 'OK';

?>