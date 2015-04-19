<?php
  session_start();
  unset($_SESSION['NUME']);
  unset($_SESSION['ID']);
?>
<!DOCTYPE html>
<head> 
  <title> chatbox </title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<form name="form_inregistrare" method="post" action="php/creare_cont.php">
  <table width="500" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#eeeeee">
    <tr>
      <td colspan="3">
        <h3 text-align="center">
          Creare cont
        </h3>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <?php 
          if(isset($_SESSION['ERORI']) &&
          is_array($_SESSION['ERORI']) && 
          count($_SESSION['ERORI']) > 0) {
            echo '<ul class="eroare">';
              foreach($_SESSION['ERORI'] as $eroare) {
                echo "<li> $eroare </li>\n";
              }
              echo "</ul>\n";
            unset($_SESSION['ERORI']);
          }

          // print mesaje de eroare
        ?>
      </td>
    </tr>
    <tr>
      <td width="130">Nume</td>
      <td width="6">:</td>
      <td width="394">
        <input name="nume" autocomplete="off" type="text" id="nume">
      </td>
    </tr>
    <tr>
      <td>Parolă</td>
      <td>:</td>
      <td>
        <input name="parola1" type="password" id="parola1">
      </td>
    </tr>
    <tr>
      <td>Parolă x2</td>
      <td>:</td>
      <td>
        <input name="parola2" type="password" id="parola2">
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="" value="Înregistrează">
      </td>
    </tr>
    <tr> 
      <td colspan="3" align="center">
        <a href="autentificare.php"> Ai deja cont? </a>
      </td>
    </tr>
  </table>
</form>




