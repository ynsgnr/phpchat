<?php
class DatabaseInit{
    public function initDatabaseTables(){
        $this->connection->exec('CREATE TABLE IF NOT EXISTS users (id int AUTO_INCREMENT, username varchar(255) UNIQUE, PRIMARY KEY (id));');
        $this->connection->exec('CREATE TABLE IF NOT EXISTS messages (id int AUTO_INCREMENT, sendby varchar(255), context longtext, sendto varchar(255), sendat timestamp, PRIMARY KEY (id), FOREIGN KEY (sendto) REFERENCES users(username), FOREIGN KEY (sendby) REFERENCES users(username));');
        //$this->connection->exec('CREATE TABLE IF NOT EXISTS sessions (id int AUTO_INCREMENT, userid int, created timestamp, PRIMARY KEY (id), FOREIGN KEY (userid) REFERENCES users(id));');
    }
}
?>