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

/***
 * Urmatorul error handler este folosit in serverul de Websocket pentru a 
 * ne asigura ca in cazul in care apare o eroare legata de uzul indelungat al
 * bazei de date, sau apare vreun index lipsa, putem sa inchidem cu succes procesul si sa 
 * asteptam sa apara altul in urma lui. 
 */
function NoticeErrorHandler($errno, $errstr, $errfile, $errline) {
    if ($errno == E_USER_NOTICE || $errno == E_USER_WARNING || $errno == E_USER_ERROR) {
        die("Died!! Error: {$errstr} on {$errfile}:{$errline}");
    }
    return false; 
}

set_error_handler('NoticeErrorHandler');

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

