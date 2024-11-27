<?php

class menu
{

    public function tree(database $database, $menu = [], $parent_id = null)
    {
        $menu = $this->level($database, $parent_id);

        foreach ($menu as $key => $level) {
            $menu[$key]['children'] = $this->tree($database, $menu, $level['id']);
        }

        return $menu;
    }

    public function level(database $database, $parent_id = null)
    {
        if ($parent_id == null) {
            return $database->list("SELECT * FROM " . $database->prefix("menu") . " WHERE parent_id is null");
        }

        return $database->list("SELECT * FROM " . $database->prefix("menu") . " WHERE parent_id = '" . $parent_id . "'");
    }
}

?>