<?php

class grid
{

    private array $fields = [];

    private array $headers = [];

    private array $items = [];

    private bool $add = false;

    private bool $edit;

    private bool $delete;

    private bool $position;

    function __construct(bool $edit = false, bool $delete = false, bool $position = false, bool $ative = false)
    {
        $this->edit = $edit;
        $this->delete = $delete;
        $this->position = $position;
        $this->ative = $ative;
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