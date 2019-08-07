<?php

require_once('api/message/mConnection/interfaces/mConnectionInterface.php');

interface mConnectionInterfaceWithDel extends mConnectionInterface{
    public function delete($id);
}

?>