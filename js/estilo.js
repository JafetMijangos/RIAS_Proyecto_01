$().ready(() => {

    $('#btnEnviar').button();
    $('#btnRegistro').button();
    $('#btnBuscar').button();
    $('#cmbFiltro').selectmenu();
    $('#cmbTipo').selectmenu();
    $("#btnCrearProducto").button();
    $("input[type='checkbox']" ).checkboxradio();
    $("#btnGestionar").button();
	$("#dlgEdProductos").dialog({
		autoOpen: false,
		show: {
			effect: "fold", 
			duration: 650
		},
		hide: {
			effect: "fold", 
			duration: 650
		},
		width:"60%",
		modal: true
	});

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
    $('#btnBuscar').click(function(event){
        let sErr="";
            event.preventDefault();
            if ($("#cmbTipo")===null ||$("#cmbTipo").val()==="" || $("#cmbFiltro")===null)
                sErr = "Faltan datos para buscar";
            else{
                $.getJSON({ 
                    url: "control/ctrlBuscaProductos.php",
                    data: { 
                        cmbTipo: $("#cmbTipo").val(),
                        cmbFiltro: $("#cmbFiltro").val()
                    }
                })
                .done( (oDatos) => {
                    procesaProductosEncontrados(oDatos);
                })
                .fail(function(objResp, status, sError){
                    sErr = sError;
                    console.log(sError);
                })
                .always(function(objResp, status){
                    console.log("Llamada externa completada con situación = "+status);
                });
            }
            if (sErr !== "")
                alert(sErr);
        });
        //Reacción al click del botón crear
        $('#btnCrearPlanta').click(function(event){
            muestraDlgEdPlantas("a", -1, $("#cmbTipo").val());
        });

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