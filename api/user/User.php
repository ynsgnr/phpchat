<?php
class User{

    private $user_id;
    private $session_id;
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
        if(isset($this->user_id) === false){
            $this->setUserId($username);
            if(isset($this->user_id) === false){
                return -1;
            }
        }
        $query = $this->connection->prepare('INSERT INTO sessions (userid,created) VALUES (?,NOW())');
        $query->execute([$this->user_id]);
        $this->session_id=$this->connection->lastInsertId();
        return $this->session_id;
    }

    public function checkSession(){
        if(isset($this->user_id) === false){
            return false;
        }
        $query = $this->connection->prepare('SELECT (id) FROM sessions WHERE userid=(?) ORDER BY created DESC LIMIT 1');
        $query->execute([$this->user_id]);
        $session_id = $query->fetchAll()[0]['id'];
        return $this->session_id == $session_id;
    }
}
?>