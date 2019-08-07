<?php
require_once('api/message/Message.php');
interface mConnectionInterface{
    public function send($message): int;
    public function recieve($id): Message;
    public function recieveAll($username): array; //array of messages
}

?>