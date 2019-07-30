<?php
class Database{

    private $host;
    private $db_name;
    private $username;
    private $password;
    public $connection;

    function __construct() {
        $this->host = $_ENV["HOST"];
        $this->db_name = $_ENV["DB_NAME"];
        $this->username = $_ENV["DB_USER"];
        $this->password = $_ENV["PASS"];
    }
 
    public function connect2database(){
 
        $this->connection = null;
 
        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error on: ". $this->host . " " . $exception->getMessage();
        }
 
        return $this->connection;
    }
}
?>