<?php

interface mConnectionInterface{
    public function send($message);
    public function recieve($id);
    public function recieveAll($username); // Check if its SOLID or not
}

?>