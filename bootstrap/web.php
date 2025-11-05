<?php
session_start();

ini_set('display_errors', 1);
ini_set('error_reporting', 1);

error_reporting(E_ALL);

$path = "";

require_once $path . 'classes/config.php';
require_once $path . 'classes/web/security.php';
require_once $path . 'classes/database.php';
require_once $path . 'classes/language.php';
require_once $path . 'classes/web/route.php';
require_once $path . 'classes/menu.php';
require_once $path . 'classes/message.php';
require_once $path . 'classes/web/variables.php';
require_once $path . 'classes/user.php';
require_once $path . 'classes/breadcrumb.php';
require_once $path . 'classes/web/layout.php';
require_once $path . 'providers/web.php';
require_once $path . 'utils/array.php';
require_once $path . 'utils/html.php';
require_once $path . 'utils/security.php';
require_once $path . 'utils/string.php';
require_once $path . 'utils/url.php';
require_once $path . 'utils/files.php';

$provider = new web($path);

require_once $path . 'views/web/layout/' . $provider->variables->layout . '.php';

$provider->dispose();

?>