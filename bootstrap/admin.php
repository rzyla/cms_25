<?php
session_start();

ini_set('display_errors', 1);
ini_set('error_reporting', 1);

error_reporting(E_ALL);

$path = "";

require_once $path . 'classes/config.php';
require_once $path . 'classes/security.php';
require_once $path . 'classes/database.php';
require_once $path . 'classes/language.php';
require_once $path . 'classes/route.php';
require_once $path . 'classes/menu.php';
require_once $path . 'classes/message.php';
require_once $path . 'classes/buttons.php';
require_once $path . 'classes/grid.php';
require_once $path . 'classes/variables.php';
require_once $path . 'classes/user.php';
require_once $path . 'classes/breadcrumb.php';
require_once $path . 'classes/layout.php';
require_once $path . 'classes/dictionary.php';
require_once $path . 'classes/module.php';
require_once $path . 'classes/security.php';
require_once $path . 'providers/admin.php';
require_once $path . 'utils/html.php';
require_once $path . 'utils/security.php';
require_once $path . 'utils/menu.php';
require_once $path . 'utils/url.php';
require_once $path . 'utils/string.php';

$provider = new admin($path);
$provider->variables->init_view();
$provider->variables->include_page($provider);
$provider->variables->check_view($provider->layout);

require_once $path . 'views/admin/layout/' . $provider->variables->layout . '.php';

$provider->dispose();

?>