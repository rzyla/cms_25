<?php

class user
{

    private ?int $acl;

    private ?int $id;

    private ?string $name;

    private ?string $avatar;

    private database $database;

    function __construct(database $database)
    {
        $this->database = $database;
        $this->init($database);
    }

    public function __get($key)
    {
        if (isset($this->$key) && !is_object($this->$key))
        {
            return $this->$key;
        }
    }

    private function init()
    {
        if (array_key_exists(consts::$value_session_admin, $_SESSION))
        {
            $user = $this->database->item("SELECT `id`, `acl`, `name`, `avatar` FROM " . consts::$table_users . " WHERE `id` = '" . $_SESSION[consts::$value_session_admin] . "'");

            if (!empty($user['id']))
            {
                $this->acl = $user['acl'];
                $this->id = $user['id'];
                $this->name = $user['name'];
                $this->avatar = $user['avatar'];
            }
        }
    }
    
    public function avatar(string $avatar)
    {
        $this->avatar = $avatar;
    }
}

?>