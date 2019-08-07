<?php

require_once('api/connectionSQL/interfaces/databaseConnectionInterface.php');

class DatabaseConfig implements databaseConnectionInterface{

    private $host;
    private $db_name;
    private $username;
    private $password;
    public $connection;

    function __construct() {
        $this->host = getenv("DB_HOST");
        $this->db_name = getenv("DB_NAME");
        $this->username = getenv("DB_USER");
        $this->password = getenv("DB_PASS");
    }
 
    public function connect2database(): PDO{
 
        $this->connection = null;
 
        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        }catch(PDOException $exception){
            throw new PDOException("Connection error on: ". $this->host . " " . $exception->getMessage());
        }
 
        return $this->connection;
    }
}
?>