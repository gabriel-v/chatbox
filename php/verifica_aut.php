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

require_once('functii.php');
require_once("bd_functii.php");
session_start();
unset($_SESSION['ERORI']);

$mesaje_erori = array();
$avem_eroare = false;

$nume = $_POST['nume'];
$parola = $_POST['parola'];

if ($nume == '') {
    $avem_eroare = true;
    $mesaje_erori[] = "Numele de utilizator lipșeste. ";
}
if ($parola == '') {
    $avem_eroare = true;
    $mesaje_erori[] = "Parola lipsește. ";
}
if (preg_match('/\\W|_/', $nume)) {
    $avem_eroare = true;
    $mesaje_erori[] = "Numele de utilizator are caractere interzise. ";
}

if ($avem_eroare == true) {
    $_SESSION['ERORI'] = $mesaje_erori;
    redirect("../autentificare.php");
} else {
    unset($_SESSION['ERORI']);
}

conectare_baza_date();
$query = "SELECT * FROM utilizatori WHERE nume=?";
$fetch = interogare_bd($query, $nume);
$hash = $fetch['hash'];

if (password_verify($parola, $hash)) {

    // autentificare ok
    $_SESSION['ID'] = $fetch['id'];
    $_SESSION['NUME'] = $fetch['nume'];
    redirect("../home.php");
} else {
    // autentificare esuata
    $mesaje_erori[] = "Autentificare eșuată";
    $_SESSION['ERORI'] = $mesaje_erori;
    redirect("../autentificare.php");
}
?>
