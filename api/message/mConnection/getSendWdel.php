<?php

require_once('api/message/mConnection/getSend.php');
require_once('api/message/mConnection/interfaces/mConnectionInterfaceWithDel.php');

class getSendWdel extends getSend{
    
    function __construct(mConnectionInterfaceWithDel $c){
        parent::__construct($c);
    }

    function delete($id){
        return $this->connection->delete($id);
    }

}

?>