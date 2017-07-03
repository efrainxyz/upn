$(document).ready(function() {
    var accion = "";
    var objerwc2016 = [];
    /* Obtener Total Registros Web */
    //var objajaxrwa = $.ajax ({
    //  type : "POST",
    //data: {'accion : obte'},
    //});    
    /* Fin Obtener Total Registros Web */
    function ObtenerRegistrosComercialesxFecha(pfechainit, pfechafin, paccion) {
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
                console.log(objrwc);
                for (i in objrwc) {
                    $("#datatable-rwc tbody").append("<tr>" + "<td>" + objrwc[i].SEDE + "</td>" + "<td>" + objrwc[i].TOTAL + "</td>" + "</tr>");
                }
                var sumarwc = 0;
                $("#datatable-rwc tbody tr").each(function() {
                    sumarwc += parseInt($(this).find('td').eq(1).text() || 0, 10)
                })
                $("#reporte-comercial-suma-rwc").append(sumarwc.toString());
                sumarwc = 0;
            }
        });
    }

    function ObtenerRegistrosNoComercialesxFecha(pfechainit, pfechafin, paccion) {
        console.log(pfechainit, pfechafin, paccion);
        var objajaxrwnc = $.ajax({
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
                var objrwnc = JSON.parse(data);
                console.log(objrwnc);
                for (i in objrwnc) {
                    $("#datatable-rwnc tbody").append("<tr>" + "<td>" + objrwnc[i].SEDE + "</td>" + "<td>" + objrwnc[i].TOTAL + "</td>" + "</tr>");
                }
                var sumarwnc = 0;
                $("#datatable-rwnc tbody tr").each(function() {
                    sumarwnc += parseInt($(this).find('td').eq(1).text() || 0, 10)
                })
                $("#reporte-comercial-suma-rwnc").append(sumarwnc.toString());
                sumarwnc = 0;
            }
        });
    }

    function ObtenerRegistrosWebComercialesxCampus(pfechainit, pfechafin, paccion) {
        console.log(pfechainit, pfechafin, paccion);
        var objajaxrwccampus = $.ajax({
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
                var objajaxrwccampus = JSON.parse(data);
                console.log(objajaxrwccampus);
                for (i in objajaxrwccampus) {
                    $("#datatable-rwc-campus tbody").append("<tr>" + "<td>" + objajaxrwccampus[i].CAMPUS + "</td>" + "<td>" + objajaxrwccampus[i].TOTAL + "</td>" + "</tr>");
                }
                var sumarwccampus = 0;
                $("#datatable-rwc-campus tbody tr").each(function() {
                    sumarwccampus += parseInt($(this).find('td').eq(1).text() || 0, 10)
                })
                $("#reporte-comercial-suma-rwc-campus").append(sumarwccampus.toString());
                sumarwccampus = 0;
            }
        });
    }

    function ObtenerRegistrosWebNoComercialesxCampus(pfechainit, pfechafin, paccion) {
        console.log(pfechainit, pfechafin, paccion);
        var objajaxrwnccampus = $.ajax({
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
                var objajaxrwnccampus = JSON.parse(data);
                console.log(objajaxrwnccampus);
                for (i in objajaxrwnccampus) {
                    $("#datatable-rwnc-campus tbody").append("<tr>" + "<td>" + objajaxrwnccampus[i].CAMPUS + "</td>" + "<td>" + objajaxrwnccampus[i].TOTAL + "</td>" + "</tr>");
                }
                var sumarwnccampus = 0;
                $("#datatable-rwnc-campus tbody tr").each(function() {
                    sumarwnccampus += parseInt($(this).find('td').eq(1).text() || 0, 10)
                })
                $("#reporte-comercial-suma-rwnc-campus").append(sumarwnccampus.toString());
                sumarwnccampus = 0;
            }
        });
    }
    $('#container-rw-history-week').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Evolución semanal de Registros Web de los años 2016 y 2017'
        },
        xAxis: {
            categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36']
        },
        yAxis: {
            title: {
                text: 'Total Registros Web'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: '2016',
            data: [279, 2933, 1451, 1500, 1265, 1227, 891, 1301, 1142, 1070, 1138, 1018, 1024, 696, 813, 967, 925, 1014, 901, 720, 940, 1014, 952, 940, 820, 874, 668, 868, 996, 992, 850, 988, 990, 939, 964, 753]
        }, {
            name: '2017',
            data: [141, 228, 383, 918, 744, 709, 585, 812, 340, 491, 491, 499, 618, 695, 707, 565, 592, 394, 507, 577, 731, 473, 521, 533, 471, 364, 514, 751, 686, 530, 647, 792, 756, 755, 740, 672]
        }],
        colors: ["#ffb602", "#4e4e56", "#8d4654", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee", "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"]
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
    $("#reporte-comercial-btn").click(function() {
        for (var i = document.getElementById("datatable-rwc").rows.length - 1; i > 0; i--) {
            document.getElementById("datatable-rwc").deleteRow(i);
        }
        for (var j = document.getElementById("datatable-rwnc").rows.length - 1; j > 0; j--) {
            document.getElementById("datatable-rwnc").deleteRow(j);
        }
        for (var j = document.getElementById("datatable-rwnc").rows.length - 1; j > 0; j--) {
            document.getElementById("datatable-rwnc").deleteRow(j);
        }
        paramfechainit = $("#fecha-reporte-rc-init").val();
        paramfechafin = $("#fecha-reporte-rc-fin").val();
        document.getElementById("reporte-comercial-anual-title").innerHTML = "";
        $("#reporte-comercial-anual-title").append("Registros Web hasta " + paramfechafin);
        document.getElementById("reporte-comercial-title").innerHTML = "";
        $("#reporte-comercial-title").append("Registros web desde " + paramfechainit + " al " + paramfechafin);
        accion = "obtener-reporte-comercial-registros-comerciales";
        ObtenerRegistrosComercialesxFecha(paramfechainit, paramfechafin, accion);
        accion = "obtener-reporte-comercial-registros-no-comerciales";
        ObtenerRegistrosNoComercialesxFecha(paramfechainit, paramfechafin, accion);
        accion = "obtener-total-registros-comerciales-campus";
        ObtenerRegistrosWebComercialesxCampus(paramfechainit, paramfechafin, accion);
        accion = "obtener-total-registros-no-comerciales-campus";
        ObtenerRegistrosWebNoComercialesxCampus(paramfechainit, paramfechafin, accion);
    });
    var linktemp = "#home";
    $("#panel-left-container ul li a").click(function() {
        link = $(this).attr("href");
        $(linktemp).css("display", "none");
        $(linktemp + "-li").removeClass("active");
        $(link).css("display", "block");
        $(link + "-li").addClass("active");
        linktemp = link;
    });
    $("#datetimepicker").datepicker();
    $("#datetimepicker-quincenal-init").datepicker();
    $("#datetimepicker-quincenal-fin").datepicker();
    $("#datetimepicker-reporte-comercial-init").datepicker();
    $("#datetimepicker-reporte-comercial-fin").datepicker();
});