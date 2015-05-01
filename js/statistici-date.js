/* * * 
 * chatbox
 * 
 * Copyright (c) Gabriel Vîjială: 2014, 2015 
 * 
 * Acest proiect a fost asamblat pentru Atestatul Profesional 
 * la terminarea liceului, pentru gradul de Programator Ajutor.
 * 
 */


var date_statistici = 
{
    "sesiuni-platforma": {
        "query": "SELECT COUNT(*) AS \"numar\", platforma \nFROM `sesiuni_autogen` \nGROUP BY platforma \nORDER BY COUNT(*) DESC \nLIMIT 10",
        "rezultat": [
            {
                "numar": "2783",
                "platforma": "Windows 7"
            },
            {
                "numar": "1654",
                "platforma": "Windows 8.1"
            },
            {
                "numar": "1220",
                "platforma": "Windows 8"
            },
            {
                "numar": "1093",
                "platforma": "Android"
            },
            {
                "numar": "782",
                "platforma": "Windows Vista"
            },
            {
                "numar": "768",
                "platforma": "Mac OS X"
            },
            {
                "numar": "677",
                "platforma": "Windows XP"
            },
            {
                "numar": "589",
                "platforma": "iPod"
            },
            {
                "numar": "587",
                "platforma": "Ubuntu"
            },
            {
                "numar": "576",
                "platforma": "iPhone"
            }
        ],
        "timp": 0.09
    },
    "sesiuni-browser": {
        "query": "SELECT COUNT(*) AS \"numar\", browser\nFROM `sesiuni_autogen`\nGROUP BY browser\nORDER BY COUNT(*) DESC\nLIMIT 10",
        "rezultat": [
            {
                "numar": "4879",
                "browser": "Chrome"
            },
            {
                "numar": "3603",
                "browser": "Firefox"
            },
            {
                "numar": "1640",
                "browser": "Internet Explorer"
            },
            {
                "numar": "1183",
                "browser": "Safari"
            },
            {
                "numar": "412",
                "browser": "Opera"
            }
        ],
        "timp": 0.088
    },
    "sesiuni-browser-platforma": {
        "query": "SELECT COUNT(*) AS \"numar\", \n       CONCAT (browser, \", \", platforma) \n       AS \"sistem\"\nFROM `sesiuni_autogen`\nGROUP BY browser, platforma\nORDER BY COUNT(*) DESC\nLIMIT 10",
        "rezultat": [
            {
                "numar": "1123",
                "sistem": "Chrome, Win 7"
            },
            {
                "numar": "853",
                "sistem": "Firefox, Win 7"
            },
            {
                "numar": "732",
                "sistem": "Chrome, Win 8.1"
            },
            {
                "numar": "527",
                "sistem": "Chrome, Win 8"
            },
            {
                "numar": "511",
                "sistem": "Firefox, Win 8.1"
            },
            {
                "numar": "438",
                "sistem": "Chrome, Android"
            },
            {
                "numar": "402",
                "sistem": "IE, Win 7"
            },
            {
                "numar": "376",
                "sistem": "Firefox, Win 8"
            },
            {
                "numar": "339",
                "sistem": "Firefox, Android"
            },
            {
                "numar": "323",
                "sistem": "Safari, Mac OS X"
            }
        ],
        "timp": 0.112
    },
    "utilizatori-mesaje-max": {
        "query": "SELECT COUNT(*) AS \"numar\", u.nume\nFROM utilizatori_autogen u\n     JOIN mesaje_autogen m\nON u.id = m.id_expeditor\nGROUP BY u.nume\nORDER BY COUNT(*) DESC\nLIMIT 10",
        "rezultat": [
            {
                "numar": "21759",
                "nume": "Diana C\u00e2r\u021ban"
            },
            {
                "numar": "20100",
                "nume": "Agnos Mihal\u021b"
            },
            {
                "numar": "19544",
                "nume": "Roxana Chelariu"
            },
            {
                "numar": "18595",
                "nume": "Adam Dinga"
            },
            {
                "numar": "18118",
                "nume": "Aida Dr\u0103gaica"
            },
            {
                "numar": "17999",
                "nume": "Ionu\u021b Miculescu"
            },
            {
                "numar": "16496",
                "nume": "Ionela Bud"
            },
            {
                "numar": "15715",
                "nume": "Lauren\u021bia Bol\u021bar"
            },
            {
                "numar": "15526",
                "nume": "Laura Seghedin"
            },
            {
                "numar": "14761",
                "nume": "Vincen\u021biu Dinic\u0103"
            }
        ],
        "timp": 20.643
    },
    "utilizatori-mesaje-min": {
        "query": "SELECT COUNT(*) AS \"numar\", u.nume\nFROM utilizatori_autogen u\n     JOIN mesaje_autogen m\nON u.id = m.id_expeditor\nGROUP BY u.nume\nORDER BY COUNT(*) ASC\nLIMIT 10",
        "rezultat": [
            {
                "numar": "9",
                "nume": "Alexandra Piu"
            },
            {
                "numar": "9",
                "nume": "Sanda Surdu"
            },
            {
                "numar": "18",
                "nume": "Angela Ciupe"
            },
            {
                "numar": "26",
                "nume": "Dinu Roc\u0103"
            },
            {
                "numar": "39",
                "nume": "\u0218erban Dona"
            },
            {
                "numar": "40",
                "nume": "Claudiu Mete\u0219"
            },
            {
                "numar": "61",
                "nume": "Frederic Gal"
            },
            {
                "numar": "67",
                "nume": "Darius Ceh"
            },
            {
                "numar": "71",
                "nume": "Alberta Popa"
            },
            {
                "numar": "73",
                "nume": "Victor Ciucea"
            }
        ],
        "timp": 20.944
    },
    "sesiuni-luna": {
        "query": "SELECT COUNT(*) AS \"numar\",\n       DATE_FORMAT(inceput, '%Y-%m') AS \"data_t\"\nFROM sesiuni_autogen\nWHERE DATE_FORMAT(`inceput`, '%Y-%m')\n      IN ('2015-01', '2015-02',\n          '2015-03', '2015-04')\nGROUP BY data_t\nORDER BY data_t ASC",
        "rezultat": [
            {
                "numar": "1010",
                "data_t": "2015-01"
            },
            {
                "numar": "3388",
                "data_t": "2015-02"
            },
            {
                "numar": "3857",
                "data_t": "2015-03"
            },
            {
                "numar": "3462",
                "data_t": "2015-04"
            }
        ],
        "timp": 0.035
    },
    "mesaje-luna": {
        "query": "SELECT COUNT(*) AS \"numar\",\n       DATE_FORMAT(`data`, '%Y-%m')\n           AS \"data_t\"\nFROM mesaje_autogen\nWHERE DATE_FORMAT(`data`, '%Y-%m')\n      IN ('2015-01', '2015-02',\n          '2015-03', '2015-04')\nGROUP BY data_t\nORDER BY data_t ASC",
        "rezultat": [
            {
                "numar": "74241",
                "data_t": "2015-01"
            },
            {
                "numar": "230950",
                "data_t": "2015-02"
            },
            {
                "numar": "258838",
                "data_t": "2015-03"
            },
            {
                "numar": "233426",
                "data_t": "2015-04"
            }
        ],
        "timp": 2.05
    },
    "durata-sesiune": {
        "query-real": "SELECT ROUND(TIME_TO_SEC(TIMEDIFF(sfarsit, inceput))\/(60 * 10), -1) AS \"minute\", \n\tROUND(COUNT(*) * 60 \/ ROUND(TIME_TO_SEC(TIMEDIFF(sfarsit, inceput))\/(60 * 10), -1)) AS \"numar\"\nFROM sesiuni_autogen\nGROUP BY minute\nORDER BY minute ASC",
        "query": "SELECT \n\tROUND(\n    \tTIME_TO_SEC(\n            TIMEDIFF(sfarsit, inceput)\n        )\/60, \n        -1\n\t) AS \"minute\", \n\tCOUNT(*) AS \"numar\"\nFROM sesiuni_autogen\nGROUP BY minute\nORDER BY minute ASC",
        "rezultat": [
            {
                "minute": "50",
                "numar": "998"
            },
            {
                "minute": "60",
                "numar": "1245"
            },
            {
                "minute": "70",
                "numar": "1106"
            },
            {
                "minute": "80",
                "numar": "902"
            },
            {
                "minute": "90",
                "numar": "807"
            },
            {
                "minute": "100",
                "numar": "734"
            },
            {
                "minute": "110",
                "numar": "652"
            },
            {
                "minute": "120",
                "numar": "628"
            },
            {
                "minute": "130",
                "numar": "559"
            },
            {
                "minute": "140",
                "numar": "451"
            }
        ],
        "timp": 0.022
    },
    "distributie-mesaje": {
        "query": "SELECT COUNT(*) AS \"numar\", \n    ROUND(\n        numar_mesaje \/ 5, -2\n    ) * 5 AS \"mesaje\" \nFROM (\n    SELECT \n        COUNT(*) \n            AS \"numar_mesaje\",\n        nume  \n    FROM mesaje_autogen m \n    JOIN utilizatori_autogen u\n    ON m.id_expeditor = u.id \n    GROUP BY u.nume\n    ) distributie_individuala\nWHERE numar_mesaje < 5000 \nGROUP BY  mesaje\nORDER BY mesaje ASC",
        "rezultat": [
            {
                "numar": "24",
                "mesaje": "0"
            },
            {
                "numar": "28",
                "mesaje": "500"
            },
            {
                "numar": "30",
                "mesaje": "1000"
            },
            {
                "numar": "17",
                "mesaje": "1500"
            },
            {
                "numar": "18",
                "mesaje": "2000"
            },
            {
                "numar": "8",
                "mesaje": "2500"
            },
            {
                "numar": "10",
                "mesaje": "3000"
            },
            {
                "numar": "7",
                "mesaje": "3500"
            },
            {
                "numar": "2",
                "mesaje": "4000"
            },
            {
                "numar": "8",
                "mesaje": "4500"
            },
            {
                "numar": "5",
                "mesaje": "5000"
            },
            {
                "numar": "5",
                "mesaje": "5500"
            },
            {
                "numar": "2",
                "mesaje": "6000"
            },
            {
                "numar": "5",
                "mesaje": "6500"
            },
            {
                "numar": "2",
                "mesaje": "7000"
            },
            {
                "numar": "5",
                "mesaje": "7500"
            },
            {
                "numar": "1",
                "mesaje": "8000"
            }
        ],
        "timp": 21.451
    }
};
