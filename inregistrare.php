<?php
  session_start();
  unset($_SESSION['NUME']);
  unset($_SESSION['ID']);
  include 'php/elemente.php'
?>
<!DOCTYPE html>
<?php echo_comentariu(); ?>
<html> 
    <head>
        <?php echo_head(); ?>
        <link rel="stylesheet" href="css/login.css">
    </head>
    
    <body>
        <?php echo_navbar(); ?>
       
        
        <!-- http://getbootstrap.com/examples/signin/ -->
        <div class="container">
            <div class="row">
             
            
          <form class="form-signin" role="login" 
                action="php/creare_cont.php" method="post">
              <?php if(isset($_SESSION['ERORI'])) { ?>
                
                <!-- inspirat din http://devgirl.org/2012/08/06/styling-your-app-with-twitter-bootstrap/ -->
                <!--<div class="alert alert-block alert-error">
                    <a class="close" data-dismiss="alert" href="#">X</a>
                    <h4 class="alert-heading">Autentificare esuata!</h4>

                </div> !-->

                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Eroare:</span>
                    <ul class="eroare">
                    <?php 
                            foreach($_SESSION['ERORI'] as $eroare) {
                              echo "<li> $eroare </li>\n";
                            }
                          unset($_SESSION['ERORI']);
                    ?>
                        </ul>
                </div>
            <?php } ?>
            <h2 class="form-signin-heading center-block text-center">
                Înregistrare
            </h2>
            <label for="inputEmail" class="sr-only">Nume</label>
            <input type="text" name="nume" id="nume" class="form-control" 
                   placeholder="Nume" required autofocus>
            <label for="inputPassword" class="sr-only">Parola</label>
            <input type="password" name="parola1" id="parola1" class="form-control" 
                   placeholder="Parola" required>
            <label for="inputPassword" class="sr-only">Repetă parola</label>
            <input type="password" name="parola2" id="parola2" class="form-control" 
                   placeholder="Repetă parola" required>
            <button class="btn btn-lg btn-primary btn-block" 
                    type="submit">Înregistrează</button>
          </form>
                </div>
            <div class="row">
                <center>
                    <a href="autentificare.php" class="btn btn-default btn-lg">
                        Ai deja cont? 
                    </a>
                </center>                
            </div>
              
        </div>
    </body>
</html>