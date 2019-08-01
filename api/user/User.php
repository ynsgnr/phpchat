<?php
class User{

    private $user_id;
    private $session_id;
    private $connection;

    function __construct(PDO $connection, $username) {
        $this->connection = $connection;
        $this->setUserId($username);
    }

    private function setUserId($username){
        $query = $this->connection->prepare('SELECT (id) FROM users WHERE username=(?)');
        $query->execute([$username]);
        $this->user_id=$query->fetchAll()[0]['id'];
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function createSession(){
        //Create a new session on sessions table
        //Then return the unique id
        //This function can be altered to add username password login later on
        if(isset($this->user_id) === false){

        } 
        $query = $this->connection->prepare('INSERT INTO sessions (userid) VALUES (?)');
        $query->execute([$this->user_id]);

    }


}
?>