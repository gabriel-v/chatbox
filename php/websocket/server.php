<?php

/* * * 
 * chatbox
 * 
 * Copyright (c) Gabriel Vîjială: 2014, 2015 
 * 
 * Acest proiect a fost asamblat pentru Atestatul Profesional 
 * la terminarea liceului, pentru gradul de Programator Ajutor.
 * 
 */

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Chatbox\ChatListener;

require dirname(__FILE__) . '/vendor/autoload.php';
require dirname(__FILE__) . '/ChatListener.php';

$server = IoServer::factory(
                new HttpServer(
                new WsServer(
                new ChatListener()
                )
                ), 8090
);

$server->run();

