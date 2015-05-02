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

require_once("bd_functii.php");
require_once("functii.php");

function afiseaza_eroare($m) {
    $_SESSION['ERORI'] = $m;
    redirect("../inregistrare.php");
}

function exista_utilizator($nume) {
    $f = interogare_bd("SELECT COUNT(*) FROM utilizatori WHERE nume=?", $nume);
    return $f['COUNT(*)'] >= 1;
}

session_start();
$nume = $_POST['nume'];
$parola1 = $_POST['parola1'];
$parola2 = $_POST['parola2'];
unset($_SESSION['ERORI']);

$mesaje_erori = array();
$avem_eroare = false;

if (strlen($parola1) < 6) {
    $avem_eroare = true;
    $mesaje_erori[] = "Parola nu poate fi mai scurta de 6 caractere. ";
}

if ($parola1 != $parola2) {
    $avem_eroare = true;
    $mesaje_erori[] = "Parolele nu coincid. ";
}

if (trim($parola1) != $parola1) {
    $avem_eroare = true;
    $mesaje_erori[] = "Parola nu poate avea spații la început sau final.";
}

if (strlen($nume) < 2) {
    $avem_eroare = true;
    $mesaje_erori[] = "Numele nu poate fi mai scurt de 2 caractere.";
}

if (preg_match('/\\W|_/', $nume)) {
    $avem_eroare = true;
    $mesaje_erori[] = "Numele de utilizator are caractere interzise.";
}


if ($avem_eroare) {
    afiseaza_eroare($mesaje_erori);
}

conectare_baza_date();
if (exista_utilizator($nume)) {
    $mesaje_erori[] = "Numele este folosit deja. ";
    afiseaza_eroare($mesaje_erori);
}

$hash = password_hash($parola1, PASSWORD_DEFAULT);
$data_ire = date('Y-m-d H:i:s');
$date_utilizator_nou = array($nume, $hash, $data_ire);

$q = "INSERT INTO utilizatori (nume, hash, data_ire) VALUES (?, ?, ?)";
inserare_bd($q, $date_utilizator_nou);

$q = "SELECT id FROM utilizatori WHERE nume=?";
$id_interog = interogare_bd($q, $nume);
$id = $id_interog['id'];

$_SESSION['ID'] = $id;
$_SESSION['NUME'] = $nume;
redirect("../home.php");
?>

