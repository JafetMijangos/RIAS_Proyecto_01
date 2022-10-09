$().ready(() => {

    $('#btnEnviar').button();
    $('#btnRegistro').button();
    $('#btnBuscar').button();
    $('#cmbLinea').selectmenu();
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
    $("#cmbLinea").selectmenu({
        change: function (event, ui) {
            switch ($(this).val()) {
                case "1":
                    $("#cmbTipo").html(getTipo());
                    break;
                case "2":
                    $("#cmbTipo").html(getTipo());
                    break;
                case "3":
                    $("#cmbTipo").html(getTipo());
                    break;
                case "4":
                    $("#cmbTipo").html(getTipo());
                    break;
                default: $("#cmbTipo").html('<option value="">Todos</option>');
            }
            $("#cmbTipo").selectmenu("refresh");
        }
    });

    //ESTO AUN NO LO USAMOS
    $('#btnBuscar').click(function(event){
        let sErr="";
            event.preventDefault();
            if ($("#cmbLinea")===null ||$("#cmbLinea").val()==="" || $("#cmbTipo")===null)
                sErr = "Faltan datos para buscar";
            else{
                $.getJSON({ 
                    url: "control/ctrlBuscaProductos.php",
                    data: { 
                        cmbLinea: $("#cmbLinea").val(),
                        cmbTipo: $("#cmbTipo").val()
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
        "color": "#fffff",
        "background-color": $("section").css("background-color"),
        "font-weight": "bold"
    });

    //Aplicación de estilo a todos los controles (input)
    //de un tipo específico
    $('input[type="radio"]').checkboxradio();
    $('input[type="checkbox"]').checkboxradio();

    function getTipo() {
        return '<option value="0">Todos</option>' +
            '<option value="1">Normal</option>' +
            '<option value="2">Dietético</option>' +
            '<option value="3">Diabético</option>' +
            '<option value="4">Vegano</option>';
    }

});