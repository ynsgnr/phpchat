<?php

require_once('api/message/Message.php');
require_once('api/message/mConnection/interfaces/mConnectionInterface.php');

class getSend extends Message{
    private $connection;

    function __construct(mConnectionInterface $c){
        parent::__construct();
        $this->connection = $c;
    }

    public function get($id){
        return $this->connection->recieve($id);
    }

    public function getAllFor($username){
        return $this->connection->recieveAll($username);
    }

    public function send(){
        return $this->connection->send($this);
    }
}

?>