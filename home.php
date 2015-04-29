<?php
session_start();
require_once("php/bd_functii.php");
require_once("php/functii.php");
require_once("php/elemente.php");

if (!isset($_SESSION['NUME']) || !isset($_SESSION['ID'])) {
    redirect("autentificare.php");
}
$nume = $_SESSION['NUME'];
$id = $_SESSION['ID'];
?>
<!DOCTYPE html>
<html>
    <head> 
        <?php        echo_head(); ?>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <script src="js/functii.js"></script>
        <script>
            $(function () {
                init();
            });
        </script>
    </head>
    <body>

        <div id="page-wrap">

            <?php            echo_navbar(true); ?>

            <div class="container container-fluid">
                <div class="row"> 
                    <div class="row-same-height row-full-height">


                        <div class="col-sm-8 col-xs-12 col-full-height">            
                            <div id="chat-wrap" class="content">
                                <h2 id="chat-titlu">&lt;=====&gt;</h2>
                                <div id="zona-mesaje"></div>
                                <form id="zona-trimitere">
                                    <textarea id="casuta" rows="1" maxlength="2000"> 
                                    </textarea>
                                </form>
                            </div> 
                        </div>

                        <div class="col-sm-4 col-xs-12 sidebar-outer col-full-height"> 
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
