<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once('api/user/uConnection/connectedUser.php');

class uRouter extends connectedUser{

    private $app;

    function __construct(uConnectionInterface $c, $app){
        parent::__construct($c);
        $this->app = $app;
    }
    
    private function uPost($request, $response, $args){
        $parsedBody = json_decode(file_get_contents('php://input'), true); //Can be changed to request object
        $this->username=$parsedBody['username'];
        if($this->create()!=-1){
            return $response;
        }else{
            return $response->withStatus(409);
        }
    }

    public function run(){
        $this->app->post('/api/v1/user', function (Request $request, Response $response, $args) {
            return $this->uPost($request, $response, $args);
        });
    }

}

?>