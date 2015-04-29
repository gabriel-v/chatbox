<?php 

/*** 
 * Copyright (c) Gabriel Vîjială: 2014, 2015 
 * 
 * Acest proiect a fost asamblat pentru Atestatul Profesional 
 * la terminarea liceului, pentru gradul de Programator Ajutor.
 * 
 */

function echo_comentariu() { ?>
<!--
    Copyright (c) Gabriel Vîjială: 2014, 2015

    Chatbox - Serviciu de mesagerie in timp real
    
    Acest proiect a fost asamblat pentru Atestatul Profesional 
    la terminarea liceului, pentru gradul de Programator Ajutor.

    Elev: Gabriel Vîjială, 
    Colegiu National "Mihai Viteazul", clasa a XII-a (promotia 2015)
--> 
<?php }

function echo_navbar($logged_in = false) {?>
<div class="navbar navbar-default navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            <a class="navbar-brand" href="index.php"><strong>chatbox</strong></a>
        </div>
        <center>
            
            <div class="collapse navbar-collapse" id="navbar-main">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Chat</a>
                    </li>
                    <li><a href="statistici.php">Statistici</a>
                    </li>
                    <li><a href="generatorul.php">Generatorul de date</a>
                    </li>
                    <li><a href="detalii.php">Despre chatbox</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <?php if($logged_in) { ?>
                        <button onclick="logout()" class="btn navbar-btn btn-default">
                            Deconectare
                        </button>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </center>
    </div>
</div>
<?php } 

function echo_head() {
?>
    <title>
        chatbox | Serviciu de mesagerie
    </title>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
<?php
}
