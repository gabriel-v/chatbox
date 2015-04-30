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
require_once("php/elemente.php");
?>
<?php echo_comentariu(); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo_head(); ?>
    </head>
    <body>
        <?php
        echo_navbar('statistici');
        ?>
        
        <div class="container">
            
            <div class="jumbotron text-center">
                <h1 class="text-center">797,455 de mesaje <br/> <small>(generate automat)</small></h1>
                <p> Pentru vizualizarea de statistici am construit un generator <br/>
                    de conținut despre care puteți afla mai multe 
                    <a class="" href="generator.php">aici</a>.
                </p>
            </div>
            
        </div>

    </body>
</html>
