<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


require_once('api/user/User.php');
require_once('api/message/mRouter.php');
require_once('api/message/mConnection/sql/mConnectionSQLwDel.php');
require_once('api/connectionSQL/DatabaseConfig.php');


require __DIR__ . '\vendor\autoload.php'; //Windows machine

$app = AppFactory::create();
//TODO add allowed methods and headers
//TODO write middleware for authentication

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$mr = new mRouter(new mConnectionSQLwDel(new DatabaseConfig()),$app);
$mr->run();

$app->run();

/*
$app->post('/api/v1/initsession', function (Request $request, Response $response, $args) {
    $database = new DatabaseConnection();
    $db = $database->connect2database();
    $user = new User($db);    
    $response->getBody()->write(
        json_encode(
            $user->createSession($data->username)
    ));
    return $response->withHeader('Content-Type', 'application/json');
});

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if($method!="POST"){
    http_response_code(404);
    echo json_encode(
        array("message" => "Wrong endpoint")
    );
}else{
    $data = json_decode(file_get_contents('php://input'));
    switch ($request) {
        case '/api/v1/initsession' :
            if (is_null($data->username)){
                http_response_code(400);
                echo json_encode(
                    array("message" => "username must exist in body")
                );
            }else{
            }
            break
        case '/api/v1/recievemessages':
            if (!isset($data->session_id) or !isset($data->username)){
                http_response_code(400);
                echo json_encode(
                    array("message" => "session_id and username must exist in body")
                );
            }
            else if ($user->checksession($data->session_id,$data->username)==false){
                http_response_code(401);
                echo json_encode(
                    array("message" => "session is not valid")
                );
            }else{
                $message = new Message();
                echo json_encode(
                    $message->receiveAllMessages($db,$data->username)
                );
            }
            break;
        default:
            http_response_code(404);
            echo json_encode(
                array("message" => "Wrong endpoint")
            );
            break;
    }
}
*/

?>