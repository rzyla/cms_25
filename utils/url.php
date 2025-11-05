<?php

function url_back($provider, string $page, ?int $parent_id = null): string
{
    return empty($parent_id) ? $provider->route->index($page) : $provider->route->child($page, $parent_id);
}

function url_content_content_id($provider, int $page_id, int $content_id, string $content_action = null)
{    
    return sprintf(consts::$path_content_content_id, $provider->config->app_admin_path, $page_id, $content_id, $content_action);
}

/*function url_images()
{
    return '/assets/images/';
}

function url_upload()
{
    return '/storage/upload/';
}*/

?>