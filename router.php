<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


require_once('api/user/uRouter.php');
require_once('api/user/uConnection/sql/uConnectionSQL.php');
require_once('api/message/mRouter.php');
require_once('api/message/mConnection/sql/mConnectionSQLwDel.php');
require_once('api/connectionSQL/DatabaseConfig.php');


require __DIR__ . '\vendor\autoload.php'; //Windows machine

$app = AppFactory::create();
//TODO add allowed methods and headers
//TODO write middleware for authentication
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$db = new DatabaseConfig();
$mr = new mRouter(new mConnectionSQLwDel($db),$app);
$mr->run();
$ur = new uRouter(new uConnectionSQL($db),$app);
$ur->run();

$app->run();