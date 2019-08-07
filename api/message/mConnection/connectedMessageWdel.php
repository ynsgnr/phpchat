<?php

require_once('api/message/mConnection/connectedMessage.php');
require_once('api/message/mConnection/interfaces/mConnectionInterfaceWithDel.php');

class connectedMessageWdel extends connectedMessage{
    
    function __construct(mConnectionInterfaceWithDel $c){
        parent::__construct($c);
    }

    protected  function delete($id){
        return $this->connection->delete($id);
    }

}

?>