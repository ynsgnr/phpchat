<?php

require_once('api/message/mConnection/sql/mConnectionSQL.php');
require_once('api/message/mConnection/interfaces/mConnectionInterfaceWithDel.php');

// SQL Connection with delete option
class mConnectionSQLwDel extends mConnectionSQL implements mConnectionInterfaceWithDel{

    public function delete($id): bool{
        $query = $this->connection->prepare('DELETE FROM messages WHERE id=? ;');
        return $query->execute([$id]);
    }
}

?>