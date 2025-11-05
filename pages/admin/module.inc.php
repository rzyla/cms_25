<?php
$items = $provider->database->list("SELECT `mm`.`id`, `mm`.`menu_id`, `mm`.`module_id`, `mmm`.`name` AS `path`, `mmm`.`parent_id`
FROM `modules` m 
JOIN `menu_modules` mm ON `m`.`id` = `mm`.`module_id` 
JOIN `menu` mmm ON `mm`.`menu_id` = `mmm`.`id` 
WHERE `m`.`file` = '" . $provider->variables->module . "'");
foreach($items as $key => $item)
{
    $menu_path = [];
    
    if ($item['parent_id'] > 0)
    {
        $tree = $provider->menu->tree_revert($item['parent_id']);

        foreach($tree as $branch)
        {
            $menu_path[] = $branch['name'];
        }
    }
    
    $menu_path[] = $items[$key]['path'];
    
    $items[$key]['path'] = implode(" / ", $menu_path);
}

$provider->grid = new grid();
$provider->grid->fields([ 
    "path"
]);
$provider->grid->headers([ 
    $provider->language->translate("page_module_header_path")
]);
$provider->grid->items($items);

foreach($provider->grid->items as $key => $item)
{
    $url = url_content_content_id($provider, $item['menu_id'], $item['id']);
    $provider->grid->actions->custom($item['id'], new grid_actions_custom_item($url, $provider->language->translate("common_button_edit"), 'bi-pencil'));
}

$provider->layout->breadcrumb->add($provider->config->app_admin_path, $provider->language->translate("breadcrumb_home"));
$provider->layout->breadcrumb->add(null, $provider->language->translate("page_partials_header_module_translate"));
$provider->layout->breadcrumb->add(null, $provider->language->translate("module_" . $provider->variables->module));
$provider->layout->title($provider->language->translate("page_partials_header_module_translate") . ': ' . $provider->language->translate("module_" . $provider->variables->module));

?>