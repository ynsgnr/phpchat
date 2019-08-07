<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once('api/message/mConnection/connectedMessageWdel.php');

class mRouter extends connectedMessageWdel{

    private $app;

    function __construct(mConnectionInterface $c, $app){
        parent::__construct($c);
        $this->app = $app;
    }
    
    private function mPost($request, $response, $args){
        $parsedBody = json_decode(file_get_contents('php://input'), true); //Can be changed to request object
        $this->sender=$parsedBody['username'];
        $this->context=$parsedBody['context'];
        $this->reciever=$parsedBody['reciever'];
        $this->send();
        //TODO add id
        return $response->withAddedHeader('Location', $_SERVER['HTTP_HOST'] . '/api/v1/message/'.$this->message_id);
    }

    private function mGet($request, $response, $args){
        $id = $args['id'];
        $message = $this->get($id);
        $response->getBody()->write(
            json_encode(
                $message
            )
        );
        return $response
        ->withHeader('Content-Type', 'application/json');
    }

    private function mDel($request, $response, $args){
        $id = $args['id'];
        if ($this->delete($id)==false){
            return $response->withStatus(404);
        }
        return $response;
    }   

    private function mGetAll($request, $response, $args){
        //Should add user check
        //Should return 404 if user not found
        $user = $args['user'];
        $messages = $this->getAllFor($user);
        $response->getBody()->write(
            json_encode(
                $messages
            )
        );
        return $response
        ->withHeader('Content-Type', 'application/json');
    }

    public function run(){
        $this->app->post('/api/v1/sendmessage', function (Request $request, Response $response, $args) {
            return $this->mPost($request, $response, $args);
        });
        
        $this->app->get('/api/v1/recievemessages/{user}',function (Request $request, Response $response, $args) {
            return $this->mGetAll($request, $response, $args); 
        });
        
        $this->app->get('/api/v1/message/{id}',function (Request $request, Response $response, $args) {
            return $this->mGet($request, $response, $args);
        });

        $this->app->delete('/api/v1/message/{id}',function (Request $request, Response $response, $args) {
            return $this->mDel($request, $response, $args);
        });
    }

}

?>