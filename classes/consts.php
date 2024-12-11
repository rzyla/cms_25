<?php 

class consts
{
    public static $slash = "/";
    public static $error_page = "errors";
    public static $error_404 = "404";
    public static $path_add = "%s%s/add";
    public static $path_insert = "%s%s/insert";
    public static $path_activate = "%s%s/activate/%d";
    public static $path_deactivate = "%s%s/deactivate/%d";
    public static $path_delete = "%s%s/delete/%d";
    public static $path_edit = "%s%s/edit/%d";
    public static $path_update = "%s%s/update/%d";
    public static $path_language = "langs/%s/%s.php";
    public static $path_page = "pages/%s/%s.php";
    public static $path_redirect = "Location: %s";
    public static $path_view = "views/%s/pages/%s/%s.php";
    
       
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
    
    public static $fields_id = "id";
    public static $fields_active = "active";
    
    public static $page_account = "account";
    public static $page_dashboard = "dashboard";
    public static $page_modules = "modules";
    public static $page_users = "users";
    
    public static $provider_admin = "admin";
    public static $provider_web = "web";
    
    public static $table_users = "users";
    public static $table_modules = "modules";
    
    public static $value_acl_none = 0;
    public static $value_acl_user = 1;
    public static $value_acl_admin = 5;
    public static $value_acl_supervisor = 9;
    public static $value_activate = 1;
    public static $value_deactivate = 0;
}

?>