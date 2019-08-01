<?php
class Database{

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
        $this->connection->exec('CREATE TABLE IF NOT EXISTS messages (id int AUTO_INCREMENT, sendby varchar(255), context longtext, sendto varchar(255), sendat timestamp, PRIMARY KEY (id), FOREIGN KEY (sendto) REFERENCES users(username), FOREIGN KEY (sendby) REFERENCES users(username));');
        $this->connection->exec('CREATE TABLE IF NOT EXISTS sessions (id int AUTO_INCREMENT, userid int, created timestamp, PRIMARY KEY (id), FOREIGN KEY (userid) REFERENCES users(id));');
    }
}
?>