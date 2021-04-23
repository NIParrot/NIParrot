<?php

//server.php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require dirname(__DIR__) . '/config.php';
    require dirname(__DIR__) . '/init.php';

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new NI_Socket()
            )
        ),
        9898
    );

    $server->run();
