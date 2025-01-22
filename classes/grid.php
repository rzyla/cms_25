<?php

class grid
{

    private array $fields = [ ];

    private array $headers = [ ];

    private array $items = [ ];

    private grid_actions $actions;

    function __construct()
    {
        $this->actions = new grid_actions();
    }

    public function __get($key)
    {
        if (isset($this->$key))
        {
            return $this->$key;
        }
    }

    public function field(string $field)
    {
        if (!in_array($field, $this->fields))
        {
            $this->fields[] = $field;
        }
    }

    public function fields(array $fields)
    {
        if (!empty($fields))
        {
            foreach($fields as $field)
            {
                if (is_string($field))
                {
                    $this->field($field);
                }
            }
        }
    }

    public function header($header)
    {
        if (!in_array($header, $this->headers))
        {
            $this->headers[] = $header;
        }
    }

    public function headers(array $headers)
    {
        if (!empty($headers))
        {
            foreach($headers as $header)
            {
                $this->header($header);
            }
        }
    }

    public function item($item)
    {
        $this->items[] = $item;
    }

    public function items(array $items)
    {
        if (!empty($items))
        {
            foreach($items as $item)
            {
                $this->item($item);
            }
        }
    }

    public function translate(language $language, string $field, string $prefix)
    {
        if (!empty($field) && !empty($this->items))
        {
            foreach($this->items as &$item)
            {
                $translate = $language->translate($prefix . $item[$field]);

                if (!empty($translate))
                {
                    $item[$field] = $translate;
                }
            }
        }
    }

    public function translate_from_dictionary(string $field, array $dictionary)
    {
        if (!empty($field) && !empty($this->items))
        {
            foreach($this->items as &$item)
            {
                $translate = $dictionary[$item[$field]];

                if (!empty($translate))
                {
                    $item[$field] = $translate;
                }
            }
        }
    }

    public function grid()
    {
        return [ 
            'fields' => $this->fields,
            'headers' => $this->headers,
            'items' => $this->items,
            'edit' => $this->edit,
            'delete' => $this->delete,
            'position' => $this->position,
            'ative' => $this->ative
        ];
    }
}

class grid_actions
{

    private bool $edit;

    private bool $delete;

    private bool $position;

    private bool $active;

    private array $custom = [ ];

    public function __get($key)
    {
        if (isset($this->$key))
        {
            return $this->$key;
        }
    }

    public function edit()
    {
        $this->edit = true;
    }

    public function delete()
    {
        $this->delete = true;
    }

    public function position()
    {
        $this->position = true;
    }

    public function active()
    {
        $this->active = true;
    }

    public function custom($key, grid_actions_custom_item $item)
    {
        $this->custom[$key][] = $item;
    }
}

class grid_actions_custom_item
{

    private string $url = "";

    private string $value = "";

    private string $icon = "";

    function __construct(string $url, string $value, string $icon)
    {
        $this->url = $url;
        $this->value = $value;
        $this->icon = $icon;
    }

    public function __get($key)
    {
        if (isset($this->$key))
        {
            return $this->$key;
        }
    }
}

?>