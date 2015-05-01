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
    switch($errno){
        CASE E_USER_NOTICE:
            echo "\nAvem o eroare NOTICE: {$errstr} in fisierul {$errfile}:{$errline}\n";
            break;
        CASE E_USER_WARNING:
            echo "\nAvem o eroare WARNING: {$errstr} in fisierul {$errfile}:{$errline}\n";
            break;
        CASE E_USER_ERROR:
            die("A murit! Error: {$errstr} on {$errfile}:{$errline}");
            break;
        default:
            echo "\nAvem o eroare NECUNOSCUTA: {$errstr} in fisierul {$errfile}:{$errline}\n";
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

