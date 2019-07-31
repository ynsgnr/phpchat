<?php
class User{

    private $user_id;
    private $session_id;
    private $connection;

    function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function create_session(){
        //Create a new session on sessions table
        //Then return the unique id
    }


}
?>