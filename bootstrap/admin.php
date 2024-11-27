<?php
session_start();

ini_set('display_errors', 1);
ini_set('error_reporting', 1);

error_reporting(E_ALL);

$path = "";

require_once $path . 'classes/config.php';
require_once $path . 'classes/database.php';
require_once $path . 'classes/language.php';
require_once $path . 'classes/route.php';
require_once $path . 'classes/menu.php';
require_once $path . 'classes/buttons.php';
require_once $path . 'classes/grid.php';
require_once $path . 'classes/variables.php';
require_once $path . 'classes/user.php';
require_once $path . 'providers/admin.php';

$admin = new admin($path);
$admin->variables->include_page($admin);
$admin->variables->check_view();

require_once $path . 'views/admin/header.php';
require_once $path . 'views/admin/body.php';
require_once $path . 'views/admin/footer.php';

$admin->dispose();

?>