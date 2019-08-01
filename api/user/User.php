<?php
class User{

    private $user_id;
    private $connection;

    function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    private function setUserId($username){
        $query = $this->connection->prepare('SELECT (id) FROM users WHERE username=(?)');
        $query->execute([$username]);
        $this->user_id=$query->fetchAll()[0]['id'];
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function createSession($username){
        //Create a new session on sessions table
        //Then return the unique id
        //This function can be altered to add username password login or security measurements later on
        $query = $this->connection->prepare('INSERT INTO sessions (userid,created) VALUES ((SELECT (id) FROM users WHERE username=(?)),NOW())');
        $query->execute([$username]);
        return $this->connection->lastInsertId();
    }

    public function checkSession($sid,$username){
        $query = $this->connection->prepare('SELECT (sessions.id) FROM sessions LEFT JOIN users ON sessions.userid=users.id WHERE users.username=(?) ORDER BY created DESC LIMIT 1;');
        $query->execute([$username]);
        $session_id = $query->fetchAll()[0]['id'];
        return $sid == $session_id;
    }
}
?>