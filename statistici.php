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
        <link rel="stylesheet" href="css/statistici.css" type="text/css" />
        <script src="js/Chart.min.js"></script>
        <script src="js/statistici-date.js"></script>
        <script src="js/statistici.js"></script>
    </head>
    <body>
        <?php
        echo_navbar('statistici');
        ?>

        <div class="container container-fluid">
            
            

            <div class="jumbotron text-center">
                <h1 class="text-center">797,455 de mesaje <br/> <small> generate automat </small></h1>
                <p> Pentru vizualizarea de statistici am construit un generator <br/>
                    de conținut despre care puteți afla mai multe 
                    <a class="" href="generator.php">aici</a>.
                </p>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="well">
                        <h2>
                            Durata unei sesiuni
                        </h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    DESCRIERE
                                </p>
                            </div>
                            <div class="col-sm-6"><pre id="durata-sesiune"></pre></div>
                        </div>
                        <div class="row">
                            <canvas  id="durata-sesiune"></canvas>
                        </div>  
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="well">
                        <h2>
                            Sesiuni / OS
                        </h2>
                        <p>
                            DESCRIERE
                        </p>
                        <pre id="sesiuni-platforma"></pre>
                        <div class="row">
                            <canvas  id="sesiuni-platforma"></canvas>
                        </div> 
                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="well">
                        <h2>
                            Sesiuni / browser
                        </h2>
                        <p>
                            DESCRIERE
                        </p>
                        <pre id="sesiuni-browser"></pre>
                        <div class="row">
                            <canvas  id="sesiuni-browser"></canvas>
                        </div> 
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="well">
                        <h2>
                            Sesiuni / sistem
                        </h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    DESCRIERE
                                </p>
                            </div>
                            <div class="col-sm-6"><pre id="sesiuni-browser-platforma"></pre></div>
                        </div>
                        <div class="row">
                            <canvas  id="sesiuni-browser-platforma"></canvas>
                        </div>  
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="well">
                        <h2>
                            Mesaje expediate
                        </h2>
                        <p>
                            DESCRIERE
                        </p>
                        <div class="row">
                            <div class="col-sm-6">
                                <!--                                <div class="row">-->
                                <pre id="utilizatori-mesaje-max"></pre>
                                <!--</div>-->
                                <div class="row">
                                    <canvas style="padding-left:40px;"  id="utilizatori-mesaje-max"></canvas>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <!--<div class="row">-->
                                <pre id="utilizatori-mesaje-min"></pre>
                                <!--</div>-->
                                <div class="row">
                                    <canvas  id="utilizatori-mesaje-min"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="well">
                        <h2>
                            Mesaje per luna
                        </h2>
                        <p>
                            DESCRIERE
                        </p>
                        <pre id="mesaje-luna"></pre>
                        <div class="row">
                            <canvas  id="mesaje-luna"></canvas>
                        </div> 
                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="well">
                        <h2>
                            Distributia mesajelor
                        </h2>
                        <p>
                            DESCRIERE
                        </p>
                        <pre id="distributie-mesaje"></pre>
                        <div class="row">
                            <canvas  id="distributie-mesaje"></canvas>
                        </div> 
                    </div>

                </div>
            </div>
        </div>

    </body>
</html>
