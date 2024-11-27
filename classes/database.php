<?php

class database
{

    private $connection;

    private string $prefix = "";

    public function __construct(config $config)
    {
        $this->prefix = $config->db_prefx();
        $this->connection = mysqli_connect($config->db_host(), $config->db_username(), $config->db_password(), $config->db_database(), $config->db_port());

        mysqli_query($this->connection, 'SET character_set_connection=utf8');
        mysqli_query($this->connection, 'SET character_set_client=utf8');
        mysqli_query($this->connection, 'SET character_set_results=utf8');
    }

    public function prefix(string $table): string
    {
        return $this->prefix . $table;
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
    
    public function dispose()
    {
        mysqli_close($this->connection);
    }
}

?>