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

/**
 * *
 * === numarul de sesiuni pe o platforma
  SELECT COUNT(*) AS "numar", platforma
  FROM `sesiuni_autogen`
  GROUP BY platforma
  ORDER BY COUNT(*) DESC
  LIMIT 10
 * 
 * === numarul de mesaje pe o platforma
  SELECT COUNT(*) AS "numar", browser
  FROM `sesiuni_autogen`
  GROUP BY browser
  ORDER BY COUNT(*) DESC
  LIMIT 10
 * 
 * === numarul de sesiuni pe o un browser pe o platforma
  SELECT COUNT(*) AS "numar", browser, platforma
  FROM `sesiuni_autogen`
  GROUP BY browser, platforma
  ORDER BY COUNT(*) DESC
  LIMIT 10
 * 
 * SELECT (SELECT COUNT(*) FROM mesaje_autogen WHERE id_expeditor = utilizatori_autogen.id) as "numar", nume from utilizatori_autogen
 * 
 * === utilizatorii cu cele mai multe mesaje
  SELECT COUNT(*) AS "numar", u.nume
  FROM utilizatori_autogen u
  JOIN mesaje_autogen m
  ON u.id = m.id_expeditor
  GROUP BY u.nume
  ORDER BY COUNT(*) DESC
  LIMIT 10
 * 
 * === utilizatorii cu cele mai putine mesaje
  SELECT COUNT(*) AS "numar", u.nume
  FROM utilizatori_autogen u
  JOIN mesaje_autogen m
  ON u.id = m.id_expeditor
  GROUP BY u.nume
  ORDER BY COUNT(*) ASC
  LIMIT 10
 * 
 * == sesiuni per luna
  SELECT COUNT(*) as "numar",
  DATE_FORMAT(inceput, '%Y-%m') as "data"
  FROM sesiuni_autogen
  WHERE DATE_FORMAT(inceput, '%Y-%m')
  IN ('2015-01', '2015-02',
  '2015-03', '2015-04')
  GROUP BY DATE_FORMAT(inceput, '%Y-%m')
  ORDER BY DATE_FORMAT(inceput, '%Y-%m') ASC
 * 
 * == mesaje per luna
 * 
  SELECT COUNT(*) as "numar",
  DATE_FORMAT(`data`, '%Y-%m') as "data"
  FROM mesaje_autogen
  WHERE DATE_FORMAT(`data`, '%Y-%m')
  IN ('2015-01', '2015-02',
  '2015-03', '2015-04')
  GROUP BY DATE_FORMAT(`data`, '%Y-%m')
  ORDER BY DATE_FORMAT(`data`, '%Y-%m') ASC
 */
$date = array();

$date['sesiuni-platforma']['query'] = <<<'END'
SELECT COUNT(*) AS "numar", platforma 
FROM `sesiuni_autogen` 
GROUP BY platforma 
ORDER BY COUNT(*) DESC 
LIMIT 10
END;

$date['sesiuni-browser']['query'] = <<<'END'
SELECT COUNT(*) AS "numar", browser
FROM `sesiuni_autogen`
GROUP BY browser
ORDER BY COUNT(*) DESC
LIMIT 10
END;

$date['sesiuni-browser-platforma']['query'] = <<<'END'
SELECT COUNT(*) AS "numar", CONCAT (browser, ", ", platforma) AS "sistem"
FROM `sesiuni_autogen`
GROUP BY browser, platforma
ORDER BY COUNT(*) DESC
LIMIT 10
END;

$date['utilizatori-mesaje-max']['query'] = <<<'END'
SELECT COUNT(*) AS "numar", u.nume
FROM utilizatori_autogen u
     JOIN mesaje_autogen m
ON u.id = m.id_expeditor
GROUP BY u.nume
ORDER BY COUNT(*) DESC
LIMIT 10
END;

$date['utilizatori-mesaje-min']['query'] = <<<'END'
SELECT COUNT(*) AS "numar", u.nume
FROM utilizatori_autogen u
     JOIN mesaje_autogen m
ON u.id = m.id_expeditor
GROUP BY u.nume
ORDER BY COUNT(*) ASC
LIMIT 10
END;

$date['sesiuni-luna']['query'] = <<<'END'
SELECT COUNT(*) as "numar",
       DATE_FORMAT(inceput, '%Y-%m') as "data_t"
FROM sesiuni_autogen
WHERE DATE_FORMAT(`inceput`, '%Y-%m')
      IN ('2015-01', '2015-02',
          '2015-03', '2015-04')
GROUP BY data_t
ORDER BY data_t ASC
END;

$date['mesaje-luna']['query'] = <<<'END'
SELECT COUNT(*) as "numar",
DATE_FORMAT(`data`, '%Y-%m') as "data_t"
FROM mesaje_autogen
WHERE DATE_FORMAT(`data`, '%Y-%m')
      IN ('2015-01', '2015-02',
          '2015-03', '2015-04')
GROUP BY data_t
ORDER BY data_t ASC
END;

$date['durata-sesiune']['query-real'] = <<<'END'
SELECT ROUND(TIME_TO_SEC(TIMEDIFF(sfarsit, inceput))/(60 * 10), -1) AS "minute", 
	ROUND(COUNT(*) * 60 / ROUND(TIME_TO_SEC(TIMEDIFF(sfarsit, inceput))/(60 * 10), -1)) AS "numar"
FROM sesiuni_autogen
GROUP BY minute
ORDER BY minute ASC
END;

$date['durata-sesiune']['query'] = <<<'END'
SELECT 
	ROUND(
    	TIME_TO_SEC(
            TIMEDIFF(sfarsit, inceput)
        )/60, 
        -1
	) AS "minute", 
	COUNT(*) AS "numar"
FROM sesiuni_autogen
GROUP BY minute
ORDER BY minute ASC
END;

$date['distributie-mesaje']['query'] = <<<'END'
SELECT COUNT(*) as "numar", 
    ROUND(
        numar_mesaje / 5, -2
    ) * 5 as "mesaje" 
FROM (
    SELECT 
        COUNT(*) 
            AS "numar_mesaje",
        nume  
    FROM mesaje_autogen m 
    JOIN utilizatori_autogen u
    ON m.id_expeditor = u.id 
    GROUP BY u.nume
    ) distributie_individuala
WHERE numar_mesaje < 8000 
GROUP BY  mesaje
ORDER BY mesaje ASC
END;

require_once('bd_functii.php');

function genereaza_date() {
    echo "incepem query-urile...";

    foreach ($date as &$element) {
        $q = $element['query'];
        if (isset($element['query-real'])) {
            $q = $element['query-real'];
        }
        //echo "\nINCERCAM QUERY PENTRU \n$q\n\n";
        $msc = microtime(true);
        $element['rezultat'] = interogare_vector_bd($q);
        $msc2 = microtime(true) - $msc;
        $element['timp'] = (int)($msc2 * 1000)/1000 + " secunde ";
    }

    //print_r($date);
    echo "<pre>\n";
    echo json_encode($date, JSON_PRETTY_PRINT);
    echo "</pre>\n";
}

$q = $date['distributie-mesaje']['query'];

//echo "\nINCERCAM QUERY PENTRU \n$q\n\n";
$msc = microtime(true);
//$date['distributie-mesaje']['rezultat'] = interogare_vector_bd($q);
$msc2 = microtime(true) - $msc;
$date['distributie-mesaje']['timp'] = (int)($msc2 * 1000)/1000 + " secunde ";

echo json_encode($date, JSON_PRETTY_PRINT);

