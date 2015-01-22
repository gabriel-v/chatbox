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
      $q = "SELECT nume, id, activ FROM utilizatori WHERE id!=?";
      $raspuns = interogare_vector_bd($q, $id);
      break;

    case "trimitere": 
      $id_destinatar = $_POST['id_destinatar'];
      $text = $_POST['text'];
      $q  = "INSERT INTO mesaje (expeditor, destinatar, text, data, citit) ";
      $q .= "VALUES (?, ?, ?, ?, ?)";
      $arg = array($id, $id_destinatar, $text, acum(), 0);
      $raspuns['ok'] = inserare_bd($q, $arg);
      break;

    case "mesaje": 
      $id2 = $_POST['cu'];
      $q = "SELECT * FROM mesaje WHERE ( expeditor=:id AND destinatar=:id2 )";
      $q.= " OR ( expeditor=:id2 AND destinatar=:id )";
      $arg = array('id' => $id, 'id2' => $id2);

      $raspuns = interogare_vector_bd($q, $arg);
      break;
    
    case "id_utilizator" :
        $raspuns['id'] = $id;
        $raspuns['nume'] = $nume;
        break;
    
    }
/*    $fh = fopen("fisier.txt", 'a') or die("nu se poate deschide fisierul");
    fwrite($fh , print_r($raspuns, true) . "\n\n");
    fclose($fh); */

    echo json_encode($raspuns);

    exit();
  ?>

