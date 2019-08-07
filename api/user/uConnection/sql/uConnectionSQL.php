<?php
require_once('api/user/User.php');
require_once('api/user/uConnection/interfaces/uConnectionInterface.php');
require_once('api/connectionSQL/interfaces/databaseConnectionInterface.php');

class uConnectionSQL implements uConnectionInterface{

    private $connection;

    function __construct(databaseConnectionInterface $db) {
        $this->connection = $db->connect2database();
    }

    public function createUser(User $user): int{
        if(isset($user->username) === false){
            throw new InvalidArgumentException("Please set sender,reciever and context!", 1);
        }
        $query = $this->connection->prepare('INSERT INTO users (username) VALUES (?);');
        if ($query->execute([$user->username])){
            $user->user_id=$this->connection->lastInsertId();
        }else{
            $user->user_id=-1;
        }
        return $user->user_id;
    }

    public function getUserId($username): int{
        $query = $this->connection->prepare('SELECT (id) FROM users WHERE username=(?)');
        $query->execute([$username]);
        return $query->fetchAll()[0]['id'];
    }
}

?>