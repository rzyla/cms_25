<?php
session_destroy();
$provider->route->redirect($provider->route->login());
?>