<?php 

class consts
{
    public static $arteh_url = "http://www.arteh.pl";
    public static $slash = "/";
    
    public static $error_page = "errors";
    public static $error_404 = "404";
    
    public static $path_list = "%s%s";
    public static $path_add = "%s%s/add/%s";
    public static $path_insert = "%s%s/insert/%s";
    public static $path_activate = "%s%s/activate/%d";
    public static $path_deactivate = "%s%s/deactivate/%d";
    public static $path_delete = "%s%s/delete/%d";
    public static $path_edit = "%s%s/edit/%d";
    public static $path_update = "%s%s/update/%d";
    public static $path_index = "%s%s";
    public static $path_position = "%s%s/position";
    public static $path_child = "%s%s/child/%d";
    public static $path_child_position = "%s%s/child/%d/position";
    public static $path_child_activate = "%s%s/child/%d/activate/%d";
    public static $path_child_deactivate = "%s%s/child/%d/deactivate/%d";
    public static $path_child_delete = "%s%s/child/%d/delete/%d";
    public static $path_child_edit = "%s%s/child/%d/edit/%d";
    public static $path_manage = "%s%s/manage/%d";
    public static $path_manage_submit = "%s%s/manage/%d/submit";
    public static $path_manage_delete = "%s%s/manage/%d/delete/%d";
    public static $path_save = "%s%s/save/%d";
    public static $path_language = "langs/%s/%s.php";
    public static $path_page = "pages/%s/%s.inc.php";
    public static $path_redirect = "Location: %s";
    public static $path_login = "%slogin";
    public static $path_logout = "%slogout";
    public static $path_view = "views/%s/pages/%s/%s.php";
    public static $path_module_configuration = "views/%s/modules/%s/configuration.inc.php";
       
    public static $request_get = "GET";
    public static $request_post = "POST";
    public static $request_token = "TOKEN";
    
    public static $server_http_referer = "HTTP_REFERER";
    public static $server_request_method = "REQUEST_METHOD";
    
    public static $app_request_token = "%s-%s-%s";
    
    public static $pages = "pages";
    public static $url = "url";
    public static $views = "views";
    
    //---
    
    public static $action_activate = "activate";
    public static $action_add = "add";
    public static $action_deactivate = "deactivate";
    public static $action_delete = "delete";
    public static $action_edit = "edit";
    public static $action_index = "index";
    public static $action_insert = "insert";
    public static $action_update = "update";
    public static $action_child = "child";
    public static $action_login = "login";
    public static $action_manage = "manage";
    public static $action_submit = "submit";
    
    public static $data_modules = "modules";
    public static $data_types = "types";
    public static $data_manage = "manage";
    public static $data_entity = "entity";
    public static $data_menu_item = "menu_item";
    //public static $data_url = "url";
    //public static $data_url_back = "back_url";
    public static $menu_breadcrumb = "menu_breadcrumb";
    
    public static $replace_id = "{id}";

    public static $fields_id = "id";
    public static $fields_active = "active";
    public static $fields_position = "position";
    
    public static $dir_avatars = "avatars";
    
    public static $icon_list_icon = "bi-list";
    public static $icon_list_class = "button-list";
    
    public static $layout_default = "default";
    public static $layout_empty = "empty";
    
    public static $module_form = "form";
    public static $module_gallery = "gallery";
    public static $module_html = "html";
    public static $module_simple_gallery = "simple_gallery";
    public static $module_news = "news";
    public static $module_meta_tags = "meta_tags";
    public static $module_maintenance = "maintenance";
    public static $module_contact = "contact";
    
    public static $message_error = false;
    public static $message_success = true;
    
    public static $page_account = "account";
    public static $page_dashboard = "dashboard";
    public static $page_menu = "menu";
    public static $page_modules = "modules";
    public static $page_users = "users";
    public static $page_configuration = "configuration";
    public static $page_partials = "partials";
    public static $page_login = "login";
    public static $page_logout = "logout";
    public static $page_module = "module";
    public static $page_contact = "contact";
    
    public static $provider_admin = "admin";
    public static $provider_web = "web";
    
    public static $table_menu = "menu";
    public static $table_menu_modules = "menu_modules";
    public static $table_modules = "modules";
    public static $table_users = "users";
    public static $table_configuration = "configuration";
    public static $table_partials = "partials";

    public static $value_acl_none = 0;
    public static $value_acl_user = 1;
    public static $value_acl_admin = 5;
    public static $value_acl_supervisor = 9;
    public static $value_activate = 1;
    public static $value_deactivate = 0;
    public static $value_menu_content = 1;
    public static $value_menu_parent = 2;
    public static $value_menu_parent_content = 3;
    public static $value_menu_url = 9;
    public static $value_target_self = 0;
    public static $value_target_blank = 1;
    public static $value_status_unavailable= 0;
    public static $value_status_available = 1;
    public static $value_module_type_static = 1;
    public static $value_module_type_dynamic = 2;
    public static $value_session_admin = "admin";
}

?>