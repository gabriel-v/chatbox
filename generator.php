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
        <link rel="stylesheet" href="css/generator.css" type="text/css" />
        <script src="js/jquery.animate-colors-min.js"></script>
        <script src="js/generator.js"></script>
        
        
    </head>
    <body>
        <?php
        echo_navbar('generator');
        ?>
        
        <div class="container">
            
            <div class="jumbotron text-center">
                <h1 class="text-center"> 162<a target='blank' href='https://github.com/gabriel-v/GeneratorConversatii'>.</a>41 MB  <br/> 
                    <small>sau aproape 1 milion de intrări</small>
                </h1>
                <h2> 
                    generate în 3 minute.
                </h2>
            </div>
            
            <div class="row">
                <div class="well well-lg">
                    <h1 class='text-center'>Generatorul de nume</h1>
                    <p>
                        Sursa de date pentru aceste nume o reprezintă Wikipedia. 
                        Mai exact, 
                        <a target="blank" href='http://ro.wikipedia.org/wiki/List%C4%83_de_prenume_rom%C3%A2ne%C8%99ti'>lista de prenume</a> și
                        <a target="blank" href='http://ro.wikipedia.org/wiki/List%C4%83_de_nume_rom%C3%A2ne%C8%99ti_-_litera_A'>lista de nume</a>, 
                        care este paginată pe litere.
                        După o scurtă inspecție am descoperit că toate numele din pagină sunt închise într-o structură HTML de tipul: </p>
                    <pre class='text-center'>&lt;li&gt;    ... title='<strong>Gheorghe</strong>' ...    &lt;/li&gt; </pre>
                    <p>Evident, pentru extragere s-a folosit următorul regex: </p>
                    
                    <pre class='text-center'>&lt;li&gt;.*title=&quot;([^&quot;: ]+)&quot;.*&lt;/li&gt;</pre>
                         <br/> 
                         <p>
                         Implementarea s-a făcut în limbajul de programare Python, versiunea 3.
                         Programul descarcă toate articolele wikipedia, le traversează și 
                         salvează rezultatele sub forma unor fișiere text.
                         Fișierele sunt disponibile 
                         <a href='python/nume/resurse/' target="blank">aici</a>.
                    </p>
                </div>
            </div>
            
            <div class="row text-center">
                <div class="row">
                    <div class="col-sm-6 col-xs-6"><h2>Nume de familie</h2></div>
                    <div class="col-sm-6 col-xs-6"><h2>Prenume</h2></div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xs-6">
                        <div class="row">
                            <div class="list-group" id="nume">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <div class="row">
                            <div class="list-group" id="prenume">
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
             <div class="row">
                <div class="well well-lg">
                    <h1 class='text-center'>Generatoare de text</h1>
                    <p id="com-gen-text">
                        Generatoarele de text sunt bazate pe
                        <a target="blank" href=http://see.stanford.edu/materials/icsppcs107/04-Assignment-1-RSG.pdf>
                            această temă de la Stanford. 
                        </a>
                    </p> 
                    <p>
                        Fiecare segment de text este generat folosind un un fișier „dicționar” care definește sintaxa: ce cuvinte pot urma unei structuri anume.
                        Din toate variantele posibile se alege una în mod aleator, obținându-se fraze aleatoare.
                      
                    </p>
                    <p>
                        Am folosit acest modul pentru a popula baza de date cu text pentru mesajele dintre utilizatori. 
                        Implementarea efectuată în Python 3 a reușit să populeze baza de date cu 797,455 în aproximativ 3 minute. 
                    </p>
                </div>
            </div>
            
            
            <div class="row text-center">
                <div class="col-sm-12">
                    <div class="row">
                        <h3>Haiku</h3>
                    </div>
                    <div class="row">
                        <div class="list-group" id="haiku">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <h3>Titluri de tabloid românesc</h3>
                    </div>
                    <div class="row">
                        <div class="list-group" id="tabloid">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <h3>Titluri de tabloid britanic</h3>
                    </div>
                    <div class="row">
                        <div class="list-group" id="wired">
                        </div>
                    </div>
                </div>
                
            </div>
           
        </div>
        
    </body>
</html>
