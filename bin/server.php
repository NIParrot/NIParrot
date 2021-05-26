<?php

//server.php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/functions.php';
require dirname(__DIR__) . '/corebootstrap.php';
require dirname(__DIR__) . '/devbootstrap.php';


$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new NI_Socket()
        )
    ),
    5858
);

$server->run();
