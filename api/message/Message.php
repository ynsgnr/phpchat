<?php
require_once('api/user/User.php');

class Message{

    private $message_id;

    public $sender;
    public $reciever;
    public $context;
    public $sendat;

    public function send(PDO $connection){
        //Add to db
        if(isset($connection) === false or isset($this->sender) === false or isset($this->reciever) === false or isset($this->context) === false){
            throw new InvalidArgumentException("Please set sender,reciever and context!", 1);
        }
        $query = $connection->prepare('INSERT INTO messages (context,sender,reciever,sendat) VALUES (?,?,?,NOW())');
        $query->execute([$this->context,$this->sender,$this->reciever]);
        $this->message_id=$connection->lastInsertId();
        return $this->message_id;
    }

    public function receiveAllMessages(PDO $connection,User $user){
        if(is_null($user->getUserId()) === true ){
            throw new InvalidArgumentException("Please set userid of user", 1);
        }
        $messages = array();
        $query = $connection->prepare('SELECT context,sender,sendat FROM messages WHERE reciever==(?) ORDER BY sendat DESC');
        $query->execute([$user->getUserId()]);
        $fetched = $query->fetchAll();
        foreach ($fetched as $m) {
            $message = new Message();
            $message->sender = $m['sender'];
            $message->reciever = $m['reciever'];
            $message->context = $m['context'];
            $message->sendat = $m['sendat'];
            array_push($messages,$message); 
        }
        return $messages;
    }
}
?>