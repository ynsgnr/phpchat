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

    public function initDatabaseTables(){
        $this->connection->exec('CREATE TABLE IF NOT EXISTS users (id int AUTO_INCREMENT, username varchar(255) UNIQUE, PRIMARY KEY (id));');
        $this->connection->exec('CREATE TABLE IF NOT EXISTS messages (id int AUTO_INCREMENT, sendby int, context longtext, sendto int, PRIMARY KEY (id), FOREIGN KEY (sendto) REFERENCES users(id), FOREIGN KEY (sendby) REFERENCES users(id));');
        $this->connection->exec('CREATE TABLE IF NOT EXISTS sessions (id int AUTO_INCREMENT, userid int, created timestamp, PRIMARY KEY (id), FOREIGN KEY (userid) REFERENCES users(id));');
    }
}
?>