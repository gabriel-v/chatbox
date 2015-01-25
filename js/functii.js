var selectat = null; 
var utilizator = null;
var scroll_blocat = true;

var websocket = null;

function init_websocket() {
    websocket = new WebSocket("ws://" + window.location.hostname +":8080");
    
    websocket.onopen = function(data) {
        trimite_ajax(
                {
                    'operatie': 'sesiune_noua'
                }, 
                function(data) {
                    data = $.parseJSON(data);
                    utilizator = data;
                    console.log("Gasit utilizator: " + data.nume + " id = " + data.id);
                    date_init = {
                        'operatie': 'initializare',
                        'cheie': utilizator.cheie_sesiune,
                    };
                    websocket.send(JSON.stringify(date_init));
                    
                });
        $('#casuta').prop('disabled', false);
        console.log("Conexiune realizata cu succes: " + JSON.stringify(data));
    };
    websocket.onmessage = function(raspuns) {
       // data = JSON.parse(data);
        text = raspuns.data;
        console.log("Primit mesaj: " + raspuns.data);
        data = JSON.parse(text);

        if(data.operatie === 'trimitere') {
            if(selectat && selectat.id === data.id_expeditor) {
                adauga_mesaj(data.text, data.id_expeditor);
            //    console.log("Adaugat mesaj: conversatie curenta, text = " + data.text);
            } else {
                var element = element_lista(data.id_expeditor);
                element.addClass('mesaj-nou');

             //   console.log("Adaugat mesaj: alta conversatie");
            }
        } else if (data.operatie === 'stare_utilizator') {
            actualizare_utilizator({'id': data.id, 'stare': data.stare});
        } else {
            console.error("Eroare (websocket.onmessage): \n\
                data.operatie nu este de tipul cunoscut");
        }
    };
    websocket.onclose = function(data) {
        console.log("Conexiunea se inchide: " + data);
        $('#casuta').prop('disabled', true);
    };
    websocket.onerror = function(data) {
        console.error("Eroare in websocket: " + data);
    };
    
}



function trimite_ajax (date, func) { 
    $.ajax({
        type: 'POST',
        url: "php/procese_ajax.php",
        data: date,
        success: func,
        error: function(a, b, c) { 
            console.log(a, b, c);
        }       
    });
}

function element_lista(id) {
    return $("#_u_" + id);
}

function actualizare_utilizator (u) {
    var p_id = "_u_"+u.id;
    if($('#' + p_id).length === 0) {
        $('<p/>', {
            id: p_id,
            click: function(){ selecteaza(u); },
            text: u.nume
        }).appendTo($("div#list-wrap"));
    }
    if(u.stare === 'online') {
        element_lista(u.id).addClass('online').removeClass('offline');
    } else if(u.stare === 'offline') {
        element_lista(u.id).removeClass('online').addClass('offline');
    }
}

function lista_utilizatori() {
    trimite_ajax(
            {'operatie': 'utilizatori'}, 
            function (data) { 
                data = $.parseJSON(data);
                utilizatori = data;
                for(var i=0; i<data.length; i++) {
                    actualizare_utilizator(data[i]);
                }
            });
}

function selecteaza(u) {
    $('#chat-titlu').text(u.nume);
    //var p = element_lista(u.id);
    if(selectat) 
        element_lista(selectat.id).removeClass('selectat');
    selectat = u;
    element_lista(selectat.id).addClass('selectat').removeClass('mesaj-nou');
    $('#casuta').val('');
    incarca_mesaje();
}

function tasta_jos(k) {
    var text = $(this).val();
    text = $.trim(text);

    if(!selectat || text.length >= $(this).attr('maxlength')) {
        event.preventDefault();
        $(this).val('');
    } else if(k.keyCode === 13) {
        trimite(text);
        $(this).val('');
    }
}

function tasta_sus(k) {
    if(k.keyCode === 13) {
        $(this).val('');
        event.preventDefault();
    }
}

function trimite(mesaj) {
    date = {
                'operatie': 'trimitere',
                'id_expeditor': utilizator.id,
                'id_destinatar': selectat.id,
                'nume_destinatar': selectat.nume,
                'text': mesaj
            };
    websocket.send(JSON.stringify(date));
    adauga_mesaj(mesaj, utilizator.id);
    //console.log("datele de trimis sunt " + JSON.stringify(date));
    trimite_ajax(
            date, 
            function(data) 
            { 
               
               // console.log("Mesaj trimis " + data); 
               // incarca_mesaje();
            });
    

}

function adauga_mesaj(text_mesaj, expeditor) {
    $('<p/>', {
        text: text_mesaj,
        id: 'mesaj',
        class: (expeditor === selectat.id ? 'mesajul-lor': 'mesajul-meu')
    }).appendTo($('#zona-mesaje'));
    //$('#zona-mesaje').scrollHeight = $('#zona-mesaje').scrollTop;
    $("#zona-mesaje").animate({ scrollTop: $('#zona-mesaje')[0].scrollHeight}, 150);
}

function incarca_mesaje() {
    if(!selectat) return;
    while($('#mesaj').length > 0) {
        $('#mesaj').remove();
    }

    trimite_ajax(
            {
                'operatie': 'mesaje',
                'cu': selectat.id
            }, 
            function(data) {
                data = $.parseJSON(data);
                for(var i = 0; i<data.length; i++) {
                    adauga_mesaj(data[i].text, data[i].expeditor);
                }
            });
}

function init() {
    $('#casuta').prop('disabled', true);
    init_websocket();
    lista_utilizatori();    
    $('#casuta').keydown(tasta_jos);
    $('#casuta').keyup (tasta_sus);
}





