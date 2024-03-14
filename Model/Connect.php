<?php

class Connect
{

    private $host = 'localhost';
    private $port = '5432'; 
    private $user = 'postgres';
    private $password = 'root';
    private $database = 'desafio3';
    
    protected $connection;

    public function __construct()
    {
       
        $this->connection = new PDO("pgsql:host=$this->host;port=$this->port;dbname=$this->database;user=$this->user;password=$this->password");

        if (!$this->connection) {
            die("Connection failed: " . pg_last_error());
        }
    }
    
    public function getConnection()
    {
        return $this->connection;
    }
}
?>