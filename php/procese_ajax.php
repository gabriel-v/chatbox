<?php 
  session_start();

  require_once("bd_functii.php");
  require_once("functii.php");

  conectare_baza_date();

  $operatie = $_POST['operatie'];
  $nume = $_SESSION['NUME'];
  $id   = $_SESSION['ID'];

  $raspuns = array();

  switch($operatie) {

    case "utilizatori": 
      $q = "SELECT nume, id, "
            . "CASE activ "
            . "WHEN 1 THEN 'online' "
            . "WHEN 0 THEN 'offline' "
            . "END AS \"stare\" "
            . "FROM utilizatori WHERE id!=? AND auto_generat = 0";
      $raspuns = interogare_vector_bd($q, $id); 
      break;

    case "trimitere": 
      $id_destinatar = $_POST['id_destinatar'];
      $text = $_POST['text'];
      $q  = "INSERT INTO mesaje (id_expeditor, id_destinatar, text, data, citit) ";
      $q .= "VALUES (?, ?, ?, ?, ?)";
      $arg = array($id, $id_destinatar, $text, acum(), 0);
      $raspuns['ok'] = inserare_bd($q, $arg);
      break;

    case "mesaje": 
      $id2 = $_POST['cu'];
      $q = "SELECT * FROM mesaje "
              . "WHERE ( id_expeditor=:id AND id_destinatar=:id2 ) "
              . "OR ( id_expeditor=:id2 AND id_destinatar=:id ) AND auto_generat = 0";
      $arg = array('id' => $id, 'id2' => $id2);

      $raspuns = interogare_vector_bd($q, $arg);
      
      $q = "UPDATE mesaje SET citit = 1 "
              . "WHERE  id_expeditor=:id2 AND id_destinatar=:id  "
              . "AND citit = 0";
      //$raspuns['update'] = inserare_bd($q, $arg);
      inserare_bd($q, $arg);
      break;
    
    case "sesiune_noua" :
        $raspuns['id'] = $id;
        $raspuns['nume'] = $nume;
        $data_acum = acum();
        $browser = gaseste_browser();
        $platforma = gaseste_sistem_operare();
        $adresa_ip = $_SERVER['REMOTE_ADDR'];
        
        // Cauta o sesiune recenta (< 100 secunde). Daca exista, refoloseste-o.
        $q = "SELECT id_sesiune, cheie_sesiune FROM sesiuni "
                . "WHERE ? - sfarsit < 100 AND "
                . "id_utilizator = ? AND "
                . "adresa_ip = ? AND "
                . "browser = ? AND "
                . "platforma = ? AND "
                . "auto_generat = 0 ";
        $sesiune_recenta = interogare_bd($q, array($data_acum, $id, $adresa_ip, $browser, $platforma));
        
        if($sesiune_recenta) {
            $q = "UPDATE sesiuni SET sfarsit = NULL WHERE id_sesiune = ?";
            inserare_bd($q, $sesiune_recenta['id_sesiune']);
            $raspuns['cheie_sesiune'] = $sesiune_recenta['cheie_sesiune'];
        } else {
            
            // genereaza o noua sesiune
            
            $q = "SELECT COUNT(*) FROM sesiuni";
            $numar_sesiuni = interogare_bd($q)['COUNT(*)'];

            $cheie = hash('sha256', rand(), false) 
                    . hash('sha256', $numar_sesiuni, false);


            $q = "INSERT INTO sesiuni "
                    . "(cheie_sesiune, id_utilizator, inceput, adresa_ip, browser, platforma) "
                    . "VALUES (?, ?, ?, ?, ?, ?)";
            $date_sesiune = array(
                $cheie, 
                $id, 
                $data_acum, 
                $adresa_ip, 
                $browser, 
                $platforma
            );

            inserare_bd($q, $date_sesiune);

            $raspuns['cheie_sesiune'] = $cheie;
        }
        
        break;
    
    }
/*    $fh = fopen("fisier.txt", 'a') or die("nu se poate deschide fisierul");
    fwrite($fh , print_r($raspuns, true) . "\n\n");
    fclose($fh); */

    echo json_encode($raspuns);

    exit();
  ?>

