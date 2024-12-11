<?php

class database
{

    private $connection;

    private string $table = "";

    private string $prefix = "";

    public function __construct(config $config)
    {
        $this->prefix = $config->db_prefx;
        $this->connection = mysqli_connect($config->db_host, $config->db_username, $config->db_password, $config->db_database, $config->db_port);

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        mysqli_query($this->connection, 'SET character_set_connection=utf8');
        mysqli_query($this->connection, 'SET character_set_client=utf8');
        mysqli_query($this->connection, 'SET character_set_results=utf8');
    }

    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }
    }

    public function prefix(string $table): string
    {
        return $this->prefix . $table;
    }

    public function table(string $table)
    {
        $this->table = $this->prefix . $table;
    }

    public function list(string $sql): array
    {
        $return = [];

        $query = mysqli_query($this->connection, $sql);
        while ($array = mysqli_fetch_assoc($query)) {
            $return[] = $array;
        }

        return $return;
    }

    public function item(string $sql)
    {
        $query = mysqli_query($this->connection, $sql);
        return mysqli_fetch_assoc($query);
    }

    public function query(string $sql)
    {
        return mysqli_query($this->connection, $sql);
    }

    public function unique(string $table, string $field, string $value): bool
    {
        $check = $this->item("SELECT 1 FROM `" . $table . "` WHERE `" . $field . "` = '" . $value . "' LIMIT 1");
        
        return empty($check);
    }

    public function dispose()
    {
        mysqli_close($this->connection);
    }
}

?>