<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Chatbox\ChatListener;

require 'vendor/autoload.php';
require 'ChatListener.php';

 $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new ChatListener()
            )
        ),
        8090
    );

$server->run();

