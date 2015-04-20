<?php
session_start();
require_once("php/bd_functii.php");
require_once("php/functii.php");

if (!isset($_SESSION['NUME']) || !isset($_SESSION['ID'])) {
    redirect("autentificare.php");
}
$nume = $_SESSION['NUME'];
$id = $_SESSION['ID'];
?>
<!DOCTYPE html>
<html>
    <head> 
        <title> chatbox </title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>

        
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css"/>
        
        <link rel="stylesheet" href="css/style.css" type="text/css" /> 
        <!--<link rel="stylesheet" href="css/height-tweaks.css" type="text/css" />--> 


        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/functii.js"></script>


        <script>
            $(function () {
                init();

            });
        </script>
    </head>
    <body>

        <div id="page-wrap">

            <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                    <div class="navbar-brand">
                        <strong> chatbox </strong>
                    </div>
                    <ul class="nav navbar-nav">
                        <li> <a> Despre </a> </li>
                        <li>
                            <form action="#">
                                <button onclick="logout()" class="btn btn-default navbar-btn">Deconectare</button>
                            </form>
                        </li>
                </div>
            </nav>

            <div class="container container-fluid">
                <div class="row"> 
                    <div class="row-same-height row-full-height">


                        <div class="col-sm-8 col-full-height">            
                            <div id="chat-wrap" class="content">
                                <h2 id="chat-titlu">--></h2>
                                <div id="zona-mesaje"></div>
                                <form id="zona-trimitere">
                                    <textarea id="casuta" rows="1" maxlength="2000"> 
                                    </textarea>
                                </form>
                            </div> 
                        </div>

                        <div class="col-sm-4 sidebar-outer col-full-height"> 
                            <div class="sidebar">
                                <div id="list-wrap" class="list-group">
                                </div>
                            </div>
                        </div>


                    </div>                
                </div>
            </div>


            <footer class="footer sticky-footer"> 
                <div class="container">
                    <div class="row">
                        <h4 class="col-sm-6"> 
                            <span id="stare-sistem" class="label label-primary">
                                
                            </span></h4>
                        <h4 class="col-sm-6 pull-right">(c) Gabriel Vîjială  2014-2015</h4>
                    </div>
                </div>
            </footer>
        </div>

    </body>
</html>
