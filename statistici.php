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

            <div class="well">
                <h2>Despre grafice si vizualizări</h2>
                <p>
                    Vizualizarea datelor joacă un rol foarte important în înțelegerea lor. 
                </p>
                <p>
                    Studiul sistemelor de baze de date, de asemenea, 
                    este o sarcină extrem de grea ce necesită orice tip de ajutor. 
                </p><p>
                    Sistemul de mai jos creează câte o vizualizare a datelor 
                    numerice rezultate dintr-o interogare SQL. 
                    Inovația acestui sistem constă în faptul că se poate alipi 
                    unui sistem deja existent de baze de date într-un mod foarte simplu.
                </p>
                <h2>Implementarea </h2>
                <p>
                <ul>
                    <li>Interogarea bazei de este date cerută în JavaScript, de către browserul vizitatorului. </li>
                    <li>Aceasta este efectuată pe server, într-un program php. </li>
                    <li>Rezultatele sunt stocate în altă bază de date, pentru uz ulterior. </li>
                    <li>Aici se păstrează și timpul necesar unei interogări.</li>
                    <li>Rezultatul este întors programului de JavaScript, unde este interpretat și afișat.</li>
                    <li>Graficele sunt afișate folosind librăria <a href="http://www.chartjs.org/">chart.js</a>.</li>
                </ul>
                <p>

                    Interogările sunt complexe și activează pe tabele cu aproape un milion de intrări. 
                    Fiind foarte costisitoare o interogare de acest tip, am folosit metoda memoizării: 
                    dacă interogarea a fost efectuată recent, se returnează direct rezultatul ei. 
                    Rezultatul este așadar valid doar pentru vizualizarea unor date aproximative, nefiind actualizate în timp real.

                </p><p>
                    Pentru nevoia acestui proiect, metoda aceasta este suficientă. 

                </p>
                <p>
                    Datele folosite pentru vizualizare sunt generate folosind un 
                    set de algoritmi ce pot fi găsiți <a href="generator.php">aici</a>.
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
                                    În chatbox, o sesiune este perioada în care un utilizator interacționează cu sistemul. Sunt stocate 
                                    date despre mobil de pe care acesta accesează sistemul și momentele în care el se 
                                    autentifică și se deconectează. În tabela sesiuni se mai păstrează și date pentru 
                                    verificarea autentificării, dar acest detaliu nu reprezintă interes în vizualizările ce urmează.
                                </p>
                                <p>
                                    Acest grafic arată cât timp durează o sesiune obișnuită.
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
                <div class="col-md-6">
                    <div class="well">
                        <h2>
                            Sesiuni / OS
                        </h2>
                        <p>
                            Sistemul de operare este identificat de către chatbox la momentul autentificării utilizatorului.
                            Fiecare sesiune stochează această informație. 
                        </p><p>
                            Merită spus că un utilizator se poate autentifica simultan de pe mai multe dispozitive. 
                            Așadar vor exista sesiuni simultane pentru același utilizator, 
                            cu intrări diferite, atât pentru sistemul de operare, cât și pentru browser.
                        </p>
                        <pre id="sesiuni-platforma"></pre>
                        <div class="row">
                            <canvas  id="sesiuni-platforma"></canvas>
                        </div> 
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="well">
                        <h2>
                            Sesiuni / browser
                        </h2>
                        <p>
                            Browserul este programul folosit pentru accesarea serviciilor web. 
                            În acest caz, pentru a comunica folosind chatbox. 
                        </p><p>
                            Această informație este, de asemenea, specifică unei sesiuni. 
                            Poate fi folosită pentru a îmbunătăți experiența utilizatorului, prin 
                            adaptarea sistemului la neajunsurile sau diferențele prezente în fiecare browser.
                        </p><p>
                            Un faimos exemplu este Internet Explorer, care nu afișează corespunzător multiple
                            elemente grafice. Acesta necesită directive speciale pentru a funcționa corespunzător.
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
                                    Din aceleași motive este importantă cunoașterea ambelor elemente: browser și OS. 
                                    Dacă este nevoie de repararea unei probleme care apare doar în Firefox pe Windows 8.1, 
                                    selecția se poate face ușor. 
                                </p>
                                <p>
                                    Dar există alt motiv, la fel de important, pentru stocarea acestor informații: statistică. 
                                    Să spunem că dorim să implementăm o funcționalitate în sistem. 
                                    Una care va face sistemul să nu mai funcționeze complet pe un anumit sistem.
                                </p>
                                <p>
                                    Având informația de mai jos, se poate face o alegere pertinentă, dacă o categorie de utilizatori 
                                    poate sau nu să fie neglijată când vine vorba de modificarea sistemului. 
                                    O problemă cu Chrome / Windows 7 va avea un impact de 3 ori mai puternic decât una pe Firefox / Windows 8.
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
                            Un mesaj conține doar datele strict necesare: 
                            expeditorul, destinatarul, data, conținutul și 
                            faptul dacă a fost sau nu citit de către destinatar.
                        </p>
                        <p>
                            Din câte se poate vedea, numărul de mesaje trimise in 4 
                            luni poate varia extrem de mult de la un set de utilizatori la altul.
                            Acest fapt poate crea probleme de performanță a sistemului de baze de date, pentru ca 
                            toate mesajele sunt stocate în aceeași tabelă pentru toți utilizatorii. După cum se poate vedea, 
                            în momentul în care a crescut numărul de rânduri din tabelă la aproape 800,000
                            performanța a scăzut dramatic.  
                        </p>
                        <p>
                            Un alt factor care dăunează performanței este natura informației stocate.
                            O structură de „coadă” va încetini setul de interogări pe o tabelă, 
                            precum este explicat 
                            <a href='https://blog.engineyard.com/2011/5-subtle-ways-youre-using-mysql-as-a-queue-and-why-itll-bite-you/'>aici</a>.
                            Evident, mesajele noastre reprezintă o coadă cronologică de date, 
                            ce trebuie sortate și verificate dacă au fost citite de destinatar.
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
                <div class="col-md-6">
                    <div class="well">
                        <h2>
                            Mesaje per lună
                        </h2>
                        <p>
                            Am simulat aici un sistem tânăr, abia scos pe piață. 
                            Cifrele sunt exagerate, desigur, dar ideea rămâne neschimbată. 
                            Când un serviciu este nou și devine popular, apare creștere precum cea din ianuarie.
                            După o vreme (de obicei mult mai scurtă decât cele 4 luni afișate aici) interesul în produs începe să scadă. 
                        </p>
                        <p>
                            Îmbunătățirea, inovarea și schimbarea, chiar și dacă sunt doar la nivel de aparențe, sunt indispensabile.
                        </p>
                        <p>
                            Trebuie notat faptul că această interogare a durat puțin peste o secundă: de 20 de ori mai puțin decât celelalte!
                            Acest fapt este datorat de prezența unui index pe coloana dată. 
                            Cum se numără mesajele ce au fost trimise în fiecare lună, toată interogarea este 
                            rezolvată din citirea index-ului, care este exact de 20 de ori mai mic decât întregimea tabelei.
                        </p>
                        <pre id="mesaje-luna"></pre>
                        <div class="row">
                            <canvas  id="mesaje-luna"></canvas>
                        </div> 
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="well">
                        <h2>
                            Distribuția mesajelor
                        </h2>
                        <p>
                            Aici am testat sistemul de partajare aleatoare a 
                            numărului de mesaje ce trebuia trimis de fiecare utilizator.
                            Rezultatul este, după cum se observă, destul de haotic.
                            Pentru a obține un rezultat ce poate fi afișat pe grafic, 
                            am limitat numărul de rezultate la utilizatorii cu mai puțin de 5000 mesaje.
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
