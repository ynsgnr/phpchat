<?php

require_once('api/message/mConnection/interfaces/mConnectionInterface.php');
include_once('api/connectionSQL/interfaces/databaseConnectionInterface.php');

class mConnectionSQL implements mConnectionInterface{

    private $connection;

    function __construct(databaseConnectionInterface $db) {
        $this->connection = $db->connect2database();
    }

    public function send($message){
        if(isset($this->connection) === false or isset($message->sender) === false or isset($message->reciever) === false or isset($message->context) === false){
            throw new InvalidArgumentException("Please set sender,reciever and context!", 1);
        }
        $query = $this->connection->prepare('INSERT INTO messages (context,sendby,sendto,sendat) VALUES (?,?,?,NOW());');
        $query->execute([$message->context,$message->sender,$message->reciever]);
        $message->message_id=$this->connection->lastInsertId();
        return $this->message_id;
    }

    public function recieve($id){
        $query = $this->connection->prepare('SELECT context,sendby,sendat,sendto FROM messages WHERE id=? ;');
        $query->execute([$id]);
        $fetched = $query->fetchAll();
        $message = new Message();
        $message->sender = $m[0]['sendby'];
        $message->reciever = $m[0]['sendto'];
        $message->context = $m[0]['context'];
        $message->sendat = $m[0]['sendat'];
        return $message;
    }

    public function recieveAll($username){
        $messages = array();
        $query = $this->connection->prepare('SELECT context,sendby,sendat FROM messages WHERE sendto=? ORDER BY sendat DESC;');
        $query->execute([$username]);
        $fetched = $query->fetchAll();
        foreach ($fetched as $m) {
            $message = new Message();
            $message->sender = $m['sendby'];
            $message->reciever = $username;
            $message->context = $m['context'];
            $message->sendat = $m['sendat'];
            array_push($messages,$message); 
        }
        return $messages;
    }
}

?>