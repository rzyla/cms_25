<?php

class grid
{

    private array $fields = [];

    private array $headers = [];

    private array $items = [];

    private bool $add;

    private bool $edit;

    private bool $delete;

    private bool $position;
    private bool $active;

    function __construct(bool $add = false, bool $edit = false, bool $delete = false, bool $position = false, bool $active = false)
    {
        $this->add = $add;
        $this->edit = $edit;
        $this->delete = $delete;
        $this->position = $position;
        $this->active = $active;
    }

    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }
    }

    public function field(string $field)
    {
        if (! in_array($field, $this->fields)) {
            $this->fields[] = $field;
        }
    }

    public function fields(array $fields)
    {
        if (! empty($fields)) {
            foreach ($fields as $field) {
                if (is_string($field)) {
                    $this->field($field);
                }
            }
        }
    }

    public function header($header)
    {
        if (! in_array($header, $this->headers)) {
            $this->headers[] = $header;
        }
    }

    public function headers(array $headers)
    {
        if (! empty($headers)) {
            foreach ($headers as $header) {
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
        if (! empty($items)) {
            foreach ($items as $item) {
                $this->item($item);
            }
        }
    }

    public function translate(language $language, string $field, string $prefix)
    {
        if (! empty($field) && ! empty($this->items)) {
            foreach ($this->items as &$item) {
                $translate = $language->translate($prefix . $item[$field]);

                if (! empty($translate)) {
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

?>