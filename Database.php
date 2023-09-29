<?php

class Database {
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '')
    {

        $dsn = 'mysql:' . http_build_query($config, '', ';'); // example.com?host=localhost;port=3306;dbname=laracastsql
    
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
        ]);
    }
    public function query($query, $params = []) 
    {
        
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        
        return $this;
    }

    public function get(): array // Specify the return type as an array
    {
        return $this->statement->fetchAll();
    }

    public function find(): ?array // Specify the return type as an optional array
    {
        return $this->statement->fetch();
    }

    public function findOrFail(): array // Specify the return type as an array
    {
        $result = $this->find();

        if (!$result) 
        {
            abort();
        }

        return $result;
    }
}