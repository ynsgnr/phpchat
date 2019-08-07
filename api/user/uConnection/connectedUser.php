<?php

require_once('api/user/User.php');
require_once('api/user/uConnection/interfaces/uConnectionInterface.php');

class connectedUser extends User{
    private $connection;

    function __construct(uConnectionInterface $c){
        parent::__construct();
        $this->connection = $c;
    }

    protected function create(){
        return $this->connection->createUser($this);
    }
}

?>