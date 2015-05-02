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

if(isset($_GET['numar'])){
    
    $numar = (int) $_GET['numar'];
} else {
    $numar = 5;
}
if(isset($_GET['tip'])){
    $tip = $_GET['tip'];
} else {
    $tip = 'kant';
}

$pid = popen( "/usr/bin/python3 '../python/ajax.py' $numar $tip 2>&1","r");
while( !feof( $pid ) )
{
 echo fread($pid, 1024);
 flush();
 ob_flush();
 usleep(10000);
}
pclose($pid);
