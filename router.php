<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('api/config/Database.php');
include_once('api/user/User.php');
include_once('api/message/Message.php');

$database = new Database();
$db = $database->connect2database();
$user = new User($db);

$request = $_SERVER->REQUEST_URI;
$method = $_SERVER->REQUEST_METHOD;

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
                echo json_encode(
                    $user->createSession($data->username)
                );
            }
            break;
        case '/api/v1/sendmessage':
            if (is_null($data->session_id) and is_null($data->sender) and is_null($data->reciever) and is_null($data->context)){
                http_response_code(400);
                echo json_encode(
                    array("message" => "session_id, sender, reciever, context must exist in body")
                );
            }
            else if ($user->checksession()==false){
                http_response_code(401);
                echo json_encode(
                    array("message" => "session is not valid")
                );
            }else{
                $message = new Message();
                $message->sender=$data->sender;
                $message->context=$data->context;
                $message->reciever=$data->reciever;
                $message->send($db);
                echo json_encode(
                    array("message" => "success")
                );
            }
        case '/api/v1/recievemessages':
            if (is_null($data->session_id)){
                http_response_code(400);
                echo json_encode(
                    array("message" => "session_id must exist in body")
                );
            }
            else if ($user->checksession()==false){
                http_response_code(401);
                echo json_encode(
                    array("message" => "session is not valid")
                );
            }else{
                $message = new Message();
                echo json_encode(
                    $message->receiveAllMessages($db,$user)
                );
            }
        default:
            http_response_code(404);
            echo json_encode(
                array("message" => "Wrong endpoint")
            );
            break;
    }
}

?>