/* * * 
 * chatbox
 * 
 * Copyright (c) Gabriel Vîjială: 2014, 2015 
 * 
 * Acest proiect a fost asamblat pentru Atestatul Profesional 
 * la terminarea liceului, pentru gradul de Programator Ajutor.
 * 
 */

$(function () {
    
//    function randomChoice(arr) {
//        return arr[Math.floor(arr.length * Math.random())];
//    }
//    
//    randomChild = function(id) {
//        //return $('#nume').eq(Math.floor($('#nume').children.length * Math.random()))
//        return $(id).eq(Math.floor($(id).children.length * Math.random()));
//    };
//    
//    
//    
//    function changeRandom(element) {
//        $.get('php/generator_ajax.php', {tip: element.attr('id'), numar: 1}, function (data) {
//            var t = JSON.parse(data)[0];
//            k = randomChild(element);
//            $(k).text(t);
//        });
//    }

    function maybeUpdate(element) {
        var c = element.children(".element-lista");
        $.get('php/generator_ajax.php', {tip: element.attr('id'), numar: c.length}, function (data) {
            console.log("Incercare de parse pentru id = " + element.attr('id') + " si mesaj = \n" + data);
            var lista = JSON.parse(data);
            
            element.children(".element-lista").each(function(i){
                if(Math.random() < 1.0 / 6.5) {
//                    $(this).animate({backgroundColor: "lightblue"}, 1300);
//                    setTimeout(function() {
//                        $(this).css("background-color", "lightblue");
//                        $(this).text(lista[i]);
//                        $(this).animate({backgroundColor: "#FFFFFF"}, 1300);
//                    }, 1300);
                    $(this).css("background-color", "lightblue");
                    $(this).text(lista[i]);
                    $(this).animate({backgroundColor: "#FFFFFF"}, 1600);
                }
                    
            });
        });
    }
    
    function update(element) {
        var c = element.children(".element-lista");
        $.get('php/generator_ajax.php', {tip: element.attr('id'), numar: c.length}, function (data) {
            var lista = JSON.parse(data);
            
            element.children(".element-lista").each(function(i){
                $(this).text(lista[i]);
                $(this).css("background-color", "white");
            });
        });
    }
    
    function descarca(element) {
        element.empty();
        $.get('php/generator_ajax.php', {tip: element.attr('id'), numar: 7}, function (data) {
            var lista = JSON.parse(data);
            for (var i = 0; i < lista.length; i++) {
                $("<p/>", {
                    click: function(){
                        update(element);
                    },
                    class: 'list-group-item element-lista',
                    text: lista[i]
                }).appendTo(element);
            }
        });
    }
  
    ['nume', 'prenume', 'haiku', 'wired', 'tabloid'].map(function (x) {
        descarca($('#' + x));
        setInterval(function(){
            maybeUpdate($('#' + x));
        }, Math.floor(1000 * (2 + 1 * Math.random())));
    });
    
    
});
