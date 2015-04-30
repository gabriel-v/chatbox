<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Chatbox\ChatListener;

require dirname(__FILE__).'/vendor/autoload.php';
require dirname(__FILE__).'/ChatListener.php';

 $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new ChatListener()
            )
        ),
        8090
    );

$server->run();

