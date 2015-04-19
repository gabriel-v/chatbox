<?php
  session_start();
  require_once("php/bd_functii.php");
  require_once("php/functii.php");

  if(!isset($_SESSION['NUME']) || !isset($_SESSION['ID'])) {
    redirect("autentificare.php");
  }
  $nume = $_SESSION['NUME'];
  $id = $_SESSION['ID'];
?>
<!DOCTYPE html>
<html>
  <head> 
    <title> chatbox </title>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="style.css" type="text/css" /> 

    <script src="js/jquery.min.js"></script>
    <script src="js/functii.js"></script>

    <script>
      $(function(){
          init();
          
      });
    </script>
  </head>
  <body>

    <div id="page-wrap">

      <header>
      <h2> CHATBOX </h2>
      <table>
          <tr>
              <td>
        <input type='button' value='Deconectare' onclick="logout()" />
              </td>
              <td>
        <p>
        <?php 
          echo "Salut, $nume! #ID = $id. | ";
          echo "IP server: {$_SERVER['SERVER_ADDR']}. | ";
          echo "IP utilizator: {$_SERVER['REMOTE_ADDR']} <br />";
        ?>
        </p>
        </td>
      </tr>
      </table>
      </header>

      <div id="chat-wrap">
        <h2 id="chat-titlu"></h2>
        <div id="zona-mesaje"></div>
        <form id="zona-trimitere">
          <textarea id="casuta" rows="1" maxlength="2000"> </textarea>
        </form>
      </div>

      <div id="list-wrap"></div>
      

      <footer> 
          <div id="stare-sistem"></div>
        <h5> Gabriel Vîjială -- 2014/2015 </h5>
      </footer>

    </div>

  </body>
</html>
