<?php

session_start();
require_once("php/functii.php");
if (isset($_SESSION['ID']) && $_SESSION['ID'] > 0) {
    redirect("home.php");
} else {
    redirect("autentificare.php");
}
?>
