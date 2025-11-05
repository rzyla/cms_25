<?php

class menu
{

    private database $database;

    function __construct(database $database)
    {
        $this->database = $database;
    }

    public function tree($menu = [ ], $parent_id = null)
    {
        $menu = $this->level($parent_id);

        foreach($menu as $key => $level)
        {
            $menu[$key]['children'] = $this->tree($menu, $level['id']);
        }

        return $menu;
    }

    public function tree_revert(?int $parent_id = null)
    {
        $menu = [ ];

        $parent_id = !empty($parent_id) ? $parent_id : 0;

        while ($parent_id > 0)
        {
            $item = $this->item($parent_id);
            $menu[] = $item;

            if (!array_key_exists('parent_id', $item) || $item['parent_id'] == null || $item['parent_id'] == 0)
            {
                $parent_id = 0;
            }
            else
            {
                $parent_id = $item['parent_id'];
            }
        }

        return array_reverse($menu);
    }

    public function level($parent_id = null)
    {
        if ($parent_id == null)
        {
            return $this->database->list("SELECT * FROM " . $this->database->prefix("menu") . " WHERE parent_id IS NULL OR parent_id = '" . consts::$value_menu_default_parent_id . "'");
        }

        return $this->database->list("SELECT * FROM " . $this->database->prefix("menu") . " WHERE parent_id = '" . $parent_id . "'");
    }

    public function item(int $id)
    {
        return $this->database->item("SELECT * FROM " . $this->database->prefix("menu") . " WHERE id = '" . $id . "'");
    }
}

?>