$(document).ready(function() {
    var accion = "";
 
    /* Obtener Total Registros Web */
    //var objajaxrwa = $.ajax ({
    //  type : "POST",
    //data: {'accion : obte'},
    //});    
    /* Fin Obtener Total Registros Web */
    function ObtenerRegistrosEmalingxFecha(pfechainit, pfechafin, paccion) {
        console.log(pfechainit, pfechafin, paccion);
        var objajaxrwc = $.ajax({
            type: "POST",
            data: {
                'accion': paccion,
                'paramfechainit': pfechainit,
                'paramfechafin': pfechafin
            },
            datatype: "json",
            url: "file.php",
            cache: "false",
            success: function(data) {
                var objrwc = JSON.parse(data);
                console.log(objrwc[0]['envios']);
                var acum="";
          
                    acum+= "<tr> <td>" +objrwc[0]['envios'] + "</td> <td>" + objrwc[0]['rebotes'] + "</td> <td>" + objrwc[0]['efectivos'] + "</td> <td>" + objrwc[0]['removidos'] + "</td> </tr>";
                
                var sumarwc = 0;
               console.log(acum);
                $("#report-total-emailing").html(acum);


                 $('#graficos-emailing').highcharts({
         title: {
        text: 'Chart.update'
    },

    subtitle: {
        text: 'Plain'
    },

    xAxis: {
        categories: ['Envios', 'Rebotes', 'Efectivos', 'Removidos']
    },

    series: [{
        type: 'column',
        colorByPoint: true,
        data: [parseInt(objrwc[0]['envios']),parseInt(objrwc[0]['rebotes']),parseInt(objrwc[0]['efectivos']), parseInt(objrwc[0]['removidos'])],
        showInLegend: false
    }]

    });
    $("#upload-file").click(function() {
        accion = "upload";
        $.ajax({
            type: "POST",
            data: {
                'accion': accion
            },
            url: "file.php"
        }).done(function(data) {
            alert("Subida del archivo completada.");
        });
    });
    $("#close-conn").click(function() {
        accion = "closeconn";
        $.ajax({
            type: "POST",
            data: {
                'accion': accion
            },
            url: "file.php"
        }).done(function(data) {
            alert("Conexxión cerrada");
        });
    });
                
            }
        });
    }



  $("#reporte-emailing-btn").click(function() {
        
        paramfechainit = $("#fecha-reporte-emailing-init").val();
        paramfechafin = $("#fecha-reporte-emailing-fin").val();

        alert(paramfechainit+" "+paramfechafin)
        document.getElementById("reporte-comercial-anual-title").innerHTML = "";
        $("#reporte-comercial-anual-title").append("Registros Emalings hasta " + paramfechafin);
        document.getElementById("reporte-comercial-title").innerHTML = "";
        $("#reporte-comercial-title").append("Registros Emalings desde " + paramfechainit + " al " + paramfechafin);
        accion = "obtener-reporte-emaling";
        ObtenerRegistrosEmalingxFecha(paramfechainit, paramfechafin, accion);
        
    });





    
    $("#datetimepicker-emailing-init").datepicker();
    $("#datetimepicker-emailing-fin").datepicker();
    
});