<?php
  session_start();
  unset($_SESSION['NUME']);
  unset($_SESSION['ID']);
?>
<!DOCTYPE html>
<head> 
  <title> CHATBOX </title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
</head>

<form name="form_login" method="post" action="php/verifica_aut.php">
  <table width="500" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#eeeeee">
    <tr>
      <td colspan="3"><h2 text-align="center">Autentificare</h2></td>
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
        <input name="parola" type="password" id="parola">
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="" value="Intră">
      </td>
    </tr>
    <tr> 
      <td colspan="3" align="center">
        <a href="inregistrare.php"> Nu ai cont? </a>
      </td>
    </table>
  </form>
