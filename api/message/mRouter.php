<?php

require_once('api/message/mConnection/getSendWdel.php');

class mRouter extends getSendWdel{
    
    public function mPost($request, $response, $args){
        $parsedBody = json_decode(file_get_contents('php://input'), true); //Can be changed to request object
        $this->sender=$parsedBody['username'];
        $this->context=$parsedBody['context'];
        $this->reciever=$parsedBody['reciever'];
        $this->send();
        //TODO add id
        return $response->withAddedHeader('Location', $_SERVER['HTTP_HOST'] . '/api/v1/sendmessage/1');
    }

}

?>