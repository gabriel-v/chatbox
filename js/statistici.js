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
    
    for (var key in date_statistici) {
        $("pre#" + key).text("-- durata query: " + date_statistici[key].timp + " secunde\n" +  date_statistici[key].query);
    }

    function extrage(coloana, nume_label) {
        var lista = date_statistici[coloana].rezultat.slice(0, 10);
        var labels = [];
        var data = [];
        for (var i = 0; i < lista.length; i++) {
            data.push(lista[i].numar);
            labels.push(lista[i][nume_label]);
        }
        return {"labels": labels, "data": data};
    }

    

    Chart.defaults.global.responsive = true;
    Chart.defaults.global.maintainAspectRatio = false;
    //Chart.defaults.global.scaleOverride = true;

    function make_data(coloana, nume_label) {
        var data_db = extrage(coloana, nume_label);
        var data = {
            labels: data_db.labels,
            datasets: [
                {
//                    label: "Sesiuni pe luna, total",
                    fillColor: "rgba(151,187,205,0.5)",
                    strokeColor: "rgba(151,187,205,0.8)",
                    highlightFill: "#007196",
                    highlightStroke: "#113377",
                    data: data_db.data
                }
            ]
        };
        return data;
    }

    function lineGraph(canvas_id, coloana, nume_label, template) {
        var ctx = $("canvas#" + canvas_id).get(0).getContext("2d");
        data = make_data(coloana, nume_label)

        if (!template || template.length < 5) {
            template = "<%if (label){%><%=label%>: <%}%><%= value %>";
        }
        new Chart(ctx).Line(data, {
            //  barShowStroke: false,
            tooltipTemplate: template,
            pointDotRadius : 7,
            pointDotStrokeWidth : 2,
            pointHitDetectionRadius : 8,
        });
    }

    function barGraph(canvas_id, coloana, nume_label, template) {
        var ctx = $("canvas#" + canvas_id).get(0).getContext("2d");
        data = make_data(coloana, nume_label);

        if (!template || template.length < 5) {
            template = "<%if (label){%><%=label%>: <%}%><%= value %>";
        }
        new Chart(ctx).Bar(data, {
            //   barShowStroke: false,
            tooltipTemplate: template
        });
    }

    function radarGraph(canvas_id, coloana, nume_label, template) {
        var ctx = $("canvas#" + canvas_id).get(0).getContext("2d");
        data = make_data(coloana, nume_label);

        if (!template || template.length < 5) {
            template = "<%if (label){%><%=label%>: <%}%><%= value %>";
        }
        new Chart(ctx).Radar(data, {
            //  barShowStroke: false,
            tooltipTemplate: template
        });
    }

    lineGraph('durata-sesiune', 'durata-sesiune', 'minute',
            "<%= value %> dintre sesiuni au in jur de <%=label %> minute");

    barGraph('sesiuni-platforma', 'sesiuni-platforma', 'platforma',
            "<%=label%>: <%= value %> sesiuni");
    barGraph('sesiuni-browser-platforma', 'sesiuni-browser-platforma', 'sistem',
            "<%=label%>: <%= value %> sesiuni");
            
    barGraph('sesiuni-browser', 'sesiuni-browser', 'browser',
            "<%=label%>: <%= value %> sesiuni");        

    lineGraph('utilizatori-mesaje-max', 'utilizatori-mesaje-max', 'nume',
            "<%=label%>: <%= value %> mesaje");
    
    lineGraph('utilizatori-mesaje-min', 'utilizatori-mesaje-min', 'nume',
            "<%=label%>: <%= value %> mesaje");
          
    lineGraph('mesaje-luna', 'mesaje-luna', 'data_t', "<%=label%>: <%= value %> mesaje");
    
    lineGraph('distributie-mesaje', 'distributie-mesaje', 'mesaje', "<%= value %> utilizatori<br> au expediat<br> <%=label%> - <%=parseInt(label)+500%> mesaje");
    
//    var data_per_luna = {
//        labels: ["Ianuarie", "Februarie", "Martie", "Aprilie"],
//        datasets: [
//            {
//                label: "Sesiuni per luna",
//                fillColor: "rgba(220,220,220,0.5)",
//                strokeColor: "rgba(220,220,220,0.8)",
//                highlightFill: "rgba(220,220,220,0.75)",
//                highlightStroke: "rgba(220,220,220,1)",
//                data: extrage('sesiuni-luna', 'data_t').data
//            },
//            {
//                label: "Mesaje per luna",
//                fillColor: "rgba(151,187,205,0.5)",
//                strokeColor: "rgba(151,187,205,0.8)",
//                highlightFill: "rgba(151,187,205,0.75)",
//                highlightStroke: "rgba(151,187,205,1)",
//                data: extrage('mesaje-luna', 'data_t').data
//            }
//        ]
//    };
//    
//    new Chart($("canvas#sesiuni-mesaje-luna")).Line(data_per_luna, {
//        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
//    });


});