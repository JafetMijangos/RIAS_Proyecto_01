$().ready(() => {

    $('#btnEnviar').button();
    $('#btnRegistro').button();
    $('#btnBuscar').button();
    $('#cmbFiltro').selectmenu();
    $('#cmbTipo').selectmenu();

    //Reacción al cambio de tipo (y aspecto gráfico)
    $("#cmbTipo").selectmenu({
        change: function (event, ui) {
            switch ($(this).val()) {
                case "1":
                    $("#cmbFiltro").html(getTamanios());
                    break;
                case "2":
                    $("#cmbFiltro").html(getTamanios());
                    break;
                case "3":
                    $("#cmbFiltro").html(getTamanios());
                    break;
                case "4":
                    $("#cmbFiltro").html(getTamanios());
                    break;
                default: $("#cmbFiltro").html('<option value="">Todos</option>');
            }
            $("#cmbFiltro").selectmenu("refresh");
        }
    });

    //ESTO AUN NO LO USAMOS


    //Comportamiento para control deslizante
    $("#precio").slider({
        range: "max",
        min: 1,
        max: 85,
        value: 20,
        slide: function (event, ui) {
            $("#txtPrecio").val(ui.value);
        }
    });
    $("#txtPrecio").val($("#precio").slider("value"));
    $("#txtPrecio").css({
        "border": "0",
        "color": "#003153",
        "background-color": $("section").css("background-color"),
        "font-weight": "bold"
    });

    //Aplicación de estilo a todos los controles (input)
    //de un tipo específico
    $('input[type="radio"]').checkboxradio();
    $('input[type="checkbox"]').checkboxradio();

    function getTamanios() {
        return '<option value="0">Todos</option>' +
            '<option value="1">Normal</option>' +
            '<option value="2">Dietético</option>' +
            '<option value="3">Diabético</option>' +
            '<option value="4">Vegano</option>';
    }

});