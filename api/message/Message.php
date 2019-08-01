<?php
class Message{

    private $message_id;
    private $connection;

    public $sender;
    public $reciever;
    public $context;

    function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function send(){
        //Add to db
        if(isset($this->sender) === false and isset($this->reciever) === false and isset($this->context) === false){
            throw new InvalidArgumentException("Please set sender,reciever and context!", 1);
        }
    }
}
?>