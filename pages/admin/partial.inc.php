<?php 

if($provider->variables->content_id == null || $provider->variables->content_id == 0)
{
    $provider->route->redirect($provider->route->route(''));
}

$module = $provider->database->item("SELECT `p`.`name`, `m`.`file` FROM `" . consts::$table_partials . "` p JOIN `modules` m on `m`.`id` = `p`.`module_id` WHERE `p`.`id`= '".$provider->variables->content_id."'");

if(empty($module))
{
    $provider->route->redirect($provider->route->route(''));
}

require_once sprintf(consts::$path_partial_module_provider, $module['file'], $this->provider);
    
$provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
$provider->layout->breadcrumb->add(null, $provider->language->translate("breadcrumb_content_edit"));
$provider->layout->title($provider->language->translate("title_partial_edit") . ": ". $module['name']);
    
$view = sprintf(consts::$path_module_view_partial_provider, $this->provider, $module['file']);

$entity = $provider->database->item("SELECT * FROM " . consts::$table_partial_module_html . " WHERE `partials_id` = '".$provider->variables->content_id . "' ORDER BY `id` LIMIT 1");

$partial[consts::$data_partial] = new module($provider->variables->content_id, consts::$module_html, $view, $entity ?? []);
    
$provider->variables->data(consts::$data_partial, $partial);

?>