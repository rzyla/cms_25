<?php

function url_back($provider, string $page, ?int $parent_id = null): string
{
    return empty($parent_id) ? $provider->route->index($page) : $provider->route->child($page, $parent_id);
}

function url_images()
{
    return '/assets/images/';
}

function url_upload()
{
    return '/storage/upload/';
}

?>