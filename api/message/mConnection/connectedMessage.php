<?php

require_once('api/message/Message.php');
require_once('api/message/mConnection/interfaces/mConnectionInterface.php');

class connectedMessage extends Message{
    private $connection;

    function __construct(mConnectionInterface $c){
        parent::__construct();
        $this->connection = $c;
    }

    protected function get($id){
        return $this->connection->recieve($id);
    }

    protected function getAllFor($username){
        return $this->connection->recieveAll($username);
    }

    protected function send(){
        return $this->connection->send($this);
    }
}

?>