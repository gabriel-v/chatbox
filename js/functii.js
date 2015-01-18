var selectat = null; 

var scroll_blocat = true;

var websocket = new WebSocket("ws://localhost:8080");
websocket.onopen = function(data) {
    console.log("Conexiune realizata cu succes: " + data);
};
websocket.onmessage = function(data) {
    console.log("Primit mesaj: " + data);
    
    if(selectat && selectat.id === data.id_expeditor) {
        adauga_mesaj(data.text_mesaj, data.id_expeditor);
    } else {
        element_lista(data.id_expeditor).addClass('mesaj_nou');
        //TODO aranjamente pentru removeClass(online / offline)
    }
};
websocket.onclose = function(data) {
    console.log("Conexiunea se inchide: " + data);
};
websocket.onerror = function(data) {
    console.error("Eroare in websocket: " + data);
};



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

function element_lista(u) {
    return $("#_u_" + u.id);
}

function actualizare_utilizator (u) {
    var p_id = "_u_"+u.id;
    if($('#' + p_id).length === 0) {
        $('<p/>', {
            id: p_id,
            click: function(){ selecteaza(u); },
            text: u.nume,
        }).appendTo($("div#list-wrap"));
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
    var p = element_lista(u);
    if(selectat) 
        element_lista(selectat).removeClass('selectat');
    selectat = u;
    element_lista(selectat).addClass('selectat');
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
                'spre': selectat.id,
                'text': mesaj
            };
    trimite_ajax(
            date, 
            function(data) 
            { 
                console.log(data); 
                incarca_mesaje();
            });
    websocket.send(date.toString());

}
function adauga_mesaj(text_mesaj, expeditor) {
    $('<p/>', {
        text: text_mesaj,
        id: 'mesaj',
        class: (expeditor === selectat.id ? 'mesajul-lor': 'mesajul-meu'),
    }).appendTo($('#zona-mesaje'));
}

function incarca_mesaje() {
    if(!selectat) return;
    while($('#mesaj').length > 0) {
        $('#mesaj').remove();
    }

    trimite_ajax(
            {
                'operatie': 'mesaje',
                'cu': selectat.id,
            }, 
            function(data) {
                data = $.parseJSON(data);
                for(var i = 0; i<data.length; i++) {
                    adauga_mesaj(data[i].text, data[i].expeditor);
                }
            });
}





