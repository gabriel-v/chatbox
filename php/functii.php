<?php 

  function acum() {
    return date('Y-m-d H:i:s');
  }

  
  function curata_sir($sir) {
    $sir = @trim($sir);
    $sir = stripslashes($sir);
    return $sir;
  }

  function redirect($link) {
    session_write_close();
    session_regenerate_id(true);
    header("location: $link");
    exit();
  }

  function tabel($vector, $id = "generic") {
    echo "<table id=\"$id\">";
    foreach($vector as $rand) {
      echo "<tr>";
      foreach($rand as $elem) {
        echo "<td> $elem </td>";
      }
      echo "</tr>";
    } 
    echo "</table>";
  }   

?>
