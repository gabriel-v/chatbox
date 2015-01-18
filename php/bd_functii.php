<?php
  $_H_ = null;
  function conectare_baza_date() {
    global $_H_;
    if($_H_ !== null) return;
    // Date pentru login in baza de date:
    $user_bd = "chat";
    $pass_bd = "ZsTpvsyhyBRq3e8V";
    $nume_bd = "chat";
    $host_bd = "localhost";
    try {
      // Creaza un DATABASE HANDLE ->
      //      un link intre aplicatia de php si serverul cu baza de date.
      $DBH = new PDO("mysql:host=$host_bd;dbname=$nume_bd", $user_bd, $pass_bd);

      // Cere ca erorile sa declanseze lansarea de exceptii.
      $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch (PDOException $e) {
      echo "<h1>", $e->getMessage(), "</h1>";
    }
    $_H_ = $DBH;
  }

  function genereaza_STH_bd($q_str, $argument) {
    global $_H_;

    if(! $_H_) {
      echo "<h1> EROARE: NU S-A FACUT CONEXIUNEA LA BAZA DE DATE! </h1>";
      debug_print_backtrace();
      exit();
    }
    $STH = $_H_->prepare($q_str);
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    if($argument===null) {
      $STH->execute();
    } else {
      // nu e null, avem un argument:

      if(is_array($argument)) {
        // argumentul este un array, trece-le pe toate
        $STH->execute($argument);
      } else {
        // argumentul este un element, treci doar elementul
        if(preg_match('/[*\']/', $argument)) {
          echo "<h1> EROARE: ARGUMENT NEVALID PENTRU: <br />" . 
            "interogare_bd($q_str, $argument) !!! </h1>";
          exit();
        }
        $STH->execute(array($argument));
      }
    }
    return $STH;
  }

  function interogare_bd($q_str, $argument = null) {
    $STH = genereaza_STH_bd($q_str, $argument);
    return $STH->fetch();
  }

  function inserare_bd( $q_str, $argument) { 
    $STH = genereaza_STH_bd($q_str, $argument);
    return $STH->rowCount();
  }

  function interogare_vector_bd($q_str, $argument = null) {
    $STH = genereaza_STH_bd($q_str, $argument);
    $vector = array();
    while($x = $STH->fetch()) $vector[] = $x;
    return $vector;
  }



?>
