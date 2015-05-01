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

    function extrage(coloana, nume_label) {
        var lista = date_statistici[coloana].rezultat;
        var labels = [];
        var data = [];
        for (var i = 0; i < lista.length; i++) {
            data.push(lista[i].numar);
            labels.push(lista[i][nume_label]);
        }
        return {"labels": labels, "data": data};
    }

    for (var key in date_statistici) {
        $("pre#" + key).text(date_statistici[key].query);
    }

    Chart.defaults.global.responsive = true;
    Chart.defaults.global.maintainAspectRatio = false;
    //Chart.defaults.global.scaleOverride = true;

    function barGraph(canvas_id, coloana, nume_label) {
        var ctx = $("canvas#" + canvas_id).get(0).getContext("2d");
        var data_db = extrage(coloana, nume_label);
        console.log("canvas_id = " + canvas_id + "; ");
        console.log(data_db);
        var data = {
            labels: data_db.labels,
            datasets: [
                {
                    label: "Sesiuni pe luna, total",
                    fillColor: "rgba(151,187,205,0.5)",
                    strokeColor: "rgba(151,187,205,0.8)",
                    highlightFill: "rgba(151,187,205,0.75)",
                    highlightStroke: "rgba(151,187,205,1)",
                    data: data_db.data
                }
            ]
        };
        
        new Chart(ctx).Bar(data, {
            barShowStroke: false
        });
    }
    
    barGraph('durata-sesiune', 'durata-sesiune', 'minute');
});