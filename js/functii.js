var selectat = null; 

var scroll_blocat = true;

function trimite_ajax (date, func) { 
    $.ajax({
        type: 'POST',
        url: "procese_ajax.php",
        data: date,
        success: func,
        error: function(a, b, c) { 
            console.log(a, b, c);
        }       
    });
}

function element_lista(u) {
    return $("#_u_" + u.nume);
}

function actualizare_utilizator (u) {
    var p_id = "_u_"+u.nume;
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
    if(selectat) element_lista(selectat).removeClass('selectat');
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
    trimite_ajax(
            {
                'operatie': 'trimitere',
                'spre': selectat.id,
                'text': mesaj, 
            }, 
            function(data) 
            { 
                console.log(data); 
                incarca_mesaje();
            });

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





