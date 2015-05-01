<?php 

/*** 
 * chatbox
 * 
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

function echo_navbar($where='nowhere') {?>
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
                    <li <?php if($where === 'home') echo 'class="active"';?>>
                        <a href="index.php">Chat</a>
                    </li>
                    <li <?php if($where === 'statistici') echo 'class="active"';?>>
                        <a href="statistici.php">Statistici</a>
                    </li>
                    <li <?php if($where === 'generator') echo 'class="active"';?>>
                        <a href="generator.php">Generatorul de date</a>
                    </li>
                    <li <?php if($where === 'detalii') echo 'class="active"';?>>
                        <a href="detalii.php">Despre chatbox</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <?php if($where === 'home') { ?>
                        <p class="navbar-text"><span id="stare-sistem" class="label label-success"></span></p>
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
    <!--<link href='http://fonts.googleapis.com/css?family=Slabo+27px&subset=latin,latin-ext' rel='stylesheet' type='text/css'>-->
    
<?php
}
