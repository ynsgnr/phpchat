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
        $this->connection->exec('CREATE TABLE IF NOT EXISTS users (id int, username varchar(255), PRIMARY KEY (id));');
        $this->connection->exec('CREATE TABLE IF NOT EXISTS messages (id int, sendby int, context longtext, sendto int, PRIMARY KEY (id), FOREIGN KEY (sendto) REFERENCES users(id), FOREIGN KEY (sendby) REFERENCES users(id));');
        $this->connection->exec('CREATE TABLE IF NOT EXISTS sessions (id int, userid int, created timestamp, FOREIGN KEY (userid) REFERENCES users(id));');
    }
}
?>