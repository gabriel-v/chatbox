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
                        le salvează rezultatele sub forma unor fișiere text.
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
                        Implementarea efectuată în Python 3 a reușit să populeze baza de date cu 797,455 mesaje în aproximativ 3 minute. 

                        Pe lângă mesaje sunt generate intrări pentru sesiuni 
                        (cu date calendaristice aleatoare) și utilizatori (cu nume aleatoare generate mai sus).
                    </p>
                    <p>
                        Experimentul a fost extrem de folositor pentru a vedea cum se comportă 
                        o bază de date MySQL cu un număr atât de mare de intrări.
                        În cazul unei tabele cu 50,000 intrări, timpii de completare a unor interogări 
                        este, de obicei, nesemnificativ, de ordinul zecilor de milisecunde. 

                    </p>
                    <p>
                        În cazul populării unei tabele cu aproape 800,000 de intrări,
                        am observat că timpul necesar pentru un simplu query 
                        <code>SELECT * FROM MESAJE WHERE id = 109275 </code> a crescut la ~2.5 secunde, iar 
                        un query mai complex precum cel ce urmează a trecut de 5.0 secunde:
                    </p>
                    <pre>
    SELECT 
        nume, 
        id, 
        CASE activ 
                WHEN 1 THEN 'online' 
                WHEN 0 THEN 'offline' 
        END AS "stare",
        (   SELECT BIT_AND(citit) 
            FROM mesaje 
            WHERE id_expeditor = u.id 
                  AND id_destinatar = :id
        ) AS "citit" 
    FROM utilizatori u 
    WHERE id!=:id   
          AND auto_generat = 0
                    </pre>
                    <p> Concluzia? Nu se pot folosi tabele cu un număr așa 
                        de mare de intrări. Nu pentru uz curent, cel puțin. 
                        Soluția este simplă totuși, se face back-up pentru datele vechi, 
                        folosind sintaxa <code>CREATE TABLE X SELECT (...)</code> 
                        sau <code>INSERT INTO X SELECT (...)</code>.
                    </p>
                    <p>
                        În urmare găsiți o demonstrație pentru generatoarele de text.
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
