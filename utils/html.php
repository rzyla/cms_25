<?php

function html_token(string $token): string
{
    return '<input type="hidden" name="' . consts::$request_token . '" value="' . $token . '" />';
}

function html_menu_level($provider, array $menu)
{
    $count = count($menu) - 1;
    $html = '';

    foreach($menu as $key => $menu)
    {
        $exists = array_key_exists($menu['id'], $provider->layout->menu_tree);

        $html .= '<li class="sidebar-menu-tree-item';

        if ($count == $key)
        {
            $html .= ' nav-menu-item-last ';
        }

        if ($menu['type'] == consts::$value_menu_parent || $menu['type'] == consts::$value_menu_parent_content)
        {
            $html .= ' nav-menu-item-plus ';

            if ($exists)
            {
                $html .= ' expand ';
            }
        }

        $html .= ' jq-menu-root-' . $menu['id'] . '">';

        if ($menu['type'] == consts::$value_menu_content)
        {
            $html .= '<a class="menu-item ';
            $html .= $exists ? ' active ' : '';
            $html .= '" href="' . $provider->route->content($menu['id']) . '"> 
                    <i class="bi bi-file-earmark menu-file"></i>
                    ' . $menu['name'] . '
				</a>';
        }

        if ($menu['type'] == consts::$value_menu_parent)
        {
            $html .= '<a href="#" class="menu-plus jq-menu-plus" data-id="' . $menu['id'] . '"></a>
                    <span class="menu-item menu-parent">
                    <i class="bi bi-folder-fill"></i>
                    ' . $menu['name'] . '
                  </span>';
            $html .= '<ul class="nav-menu-ul jq-menu-' . $menu['id'] . ' ';
            $html .= !array_key_exists($menu['id'], $provider->layout->menu_tree) ? 'display-none' : '';
            $html .= '">';
            $html .= html_menu_level($provider, $menu['children']);
            $html .= '</ul>';
        }

        if ($menu['type'] == consts::$value_menu_parent_content)
        {
            $html .= '<a href="#" class="menu-plus jq-menu-plus" data-id="' . $menu['id'] . '"></a>
                    <a class="menu-item menu-parent';
            $html .= $exists ? ' active ' : '';
            $html .= '" href="' . $provider->route->content($menu['id']) . '">
                    <i class="bi bi-folder-fill"></i>
                    ' . $menu['name'] . '
                  </a>';
            $html .= '<ul class="nav-menu-ul jq-menu-' . $menu['id'] . ' ';
            $html .= !array_key_exists($menu['id'], $provider->layout->menu_tree) ? 'display-none' : '';
            $html .= '">';
            $html .= html_menu_level($provider, $menu['children']);
            $html .= '</ul>';
        }

        if ($menu['type'] == consts::$value_menu_url)
        {
            $html .= '<span class="menu-item">
                    <i class="bi bi-file-earmark-arrow-up menu-file"></i>
                    ' . $menu['name'] . '
                  </span>';
        }

        $html .= '</li>';
    }

    return $html;
}

function html_menu_options_tree(array $menu = [ ], string $name = '', int $selected = 0)
{
    $array = [ ];

    foreach($menu as $key => $value)
    {
        $_name = !empty($name) ? $name . ' > ' . $value['name'] : $value['name'];
        $_selected = $value['id'] == $selected ? 'selected = "selected"' : '';
        $array[] = '<option value="' . $value['id'] . '" ' . $_selected . '>' . $_name . '</option>';

        if (!empty($value['children']))
        {
            $array[] = html_menu_options_tree($value['children'], $_name, $selected);
        }
    }

    return implode('', $array);
}

?>