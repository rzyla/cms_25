<?php

$provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
$provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_" . consts::$page_contact . "_index"));
$provider->layout->title($provider->language->translate("title_" . consts::$page_contact . "_index"));

?>