<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('api/config/Database.php');

$database = new Database();
$db = $database->connect2database();

function unit_test_this(){
    return true;
}

?>