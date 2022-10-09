/*
Archivo:  ctrlBuscaProductos.js
Objetivo: código de JavaScript para realizar llamada parcial a PHP para consultar 
		  productos 
Autor:    Pasteleria
*/
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
        "border": "1",
        "color": "#000000",
        "font-weight": "bold"
    });

//Cosas importantes 
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
                default: $("#cmbTipo").html('<option value="0">Todos</option>');
            }
            $("#cmbTipo").selectmenu("refresh");
        }
    });



	$('#btnCrearProducto').click(function (event) {
		muestraDlgEdProductos("a", -1);
	});

	$("#frmEdProductos").submit(function (event) {
		let sErr = "";
		let oFrmDatos = new FormData();
		event.preventDefault();
		if ($("#txtOpe").val() === "b" ||
			$("#frmEdProductos")[0].checkValidity()) {
			//Ya no verifica elementos porque, de no existir, no habría llegado a este punto
			oFrmDatos.append("txtCve", $("#txtCve").val());
			oFrmDatos.append("txtOpe", $("#txtOpe").val());
			oFrmDatos.append("txtNom", $("#txtNom").val());
			oFrmDatos.append("cmbLineaD", $("#cmbLineaD").val());
			oFrmDatos.append("cmbTipoD", $("#cmbTipoD").val());
			oFrmDatos.append("txtDescripcion", $("#txtDescripcion").val());
			oFrmDatos.append("txtSabor", $("#txtSabor").val());
			oFrmDatos.append("txtPrecio", $("#txtPrecio").val());
			oFrmDatos.append("txtImg", $("#txtImg")[0].files[0]);
			$.ajax({
				url: "control/ctrlGestionarProducto.php",
				type: "post",
				data: oFrmDatos,
				processData: false,
				contentType: false
			})
				.done((oDatos) => {
					if (oDatos.success) {
						swal("Éxito","Datos almacenados", "success");
						$("#dlgEdProductos").dialog("close");
						$("#frmBuscarProd").css("display", "block");
						$("#resBuscarProd").css("display", "none");
					} else {
						swal("Error","Error al almacenar: " + oDatos.status,"warning");
					}
				})
				.fail(function (objResp, status, sError) {
					swal("Error", "El servidor indica error al procesar", "warning");
					console.log(sError);
				})
		} //Los errores de validación los indicó HTML5
	});

//Agregar funcion muestraDlgProductos 238 de la profa
$('#btnBuscar').click(function(event){
	let sErr="";
		event.preventDefault();
		if ($("#cmbLinea")===null ||$("#cmbLinea").val()==="" || $("#cmbTipo")===null)
			sErr = "Faltan datos para buscar";
		else{
			$.getJSON({ 
				url: "control/ctrlBuscaProducto.php",
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



	function muestraDlgEdProductos(sOpe, nClave/*, nTipo*/){
		let sTitulo = "";
		let sErr = "";
		let bDisabled = false;
			//Decidir título de diálogo y botón
			switch(sOpe){
				case "a": sTitulo="Crear Nuevo";
					break;
				case "b": sTitulo="Eliminar";
					break;
				case "m": sTitulo="Modificar";
					break;
				default: sTitulo="Error";
			}
			$("#dlgEdProductos").dialog("option", "title", sTitulo+" postre");
			$("#btnGestionar").val(sTitulo);
			//Limpiar campos de captura y colocar valores por omisión
			$("#frmEdProductos")[0].reset();
			$("#txtCve").val(nClave);
			//$("#txtTipo").val(nTipo);
			$("#txtOpe").val(sOpe);
			
		

			if (sOpe==="b"){
				bDisabled = true;
				$("#frmEdProductos").attr("novalidate","novalidate");
			}else{
				bDisabled = false;
				$("#frmEdProductos").attr("novalidate","");
			}
			//Cargar datos externos si ya existe la planta
			if (sOpe === "b" || sOpe === "m"){
				$.getJSON({ 
					url: "control/ctrlBuscarUnProducto.php",
					data: { 
						txtCve: nClave
					}
				})
				.done( (oDatos) => {
					$("#txtNom").val(oDatos.data.nombre);
					$("#cmbLineaD").val(oDatos.data.linea);
					
					$("#cmbTipoD").val(oDatos.data.tipo);

					$("#txtDescripcion").val(oDatos.data.descripcion);
					$("#txtSabor").val(oDatos.data.sabor);
					$("#txtPrecio").val(oDatos.data.precio);
					$("#cmbLineaD").selectmenu("refresh");
					$("#cmbTipoD").selectmenu("refresh");
				})
				.fail(function(objResp, status, sError){
					sErr = sError;
					console.log(sError);
				});
			}
			if (sErr=== ""){
				$("#txtNom").prop({disabled: bDisabled});
				$("#cmbLineaD").prop({disabled: bDisabled});
				$("#cmbTipoD").prop({disabled: bDisabled});
				$("#txtDescripcion").prop({disabled: bDisabled});
				$("#txtSabor").prop({disabled: bDisabled});
				$("#txtPrecio").prop({disabled: bDisabled});
				$("#txtImg").prop({disabled: bDisabled});
				$("#dlgEdProductos").dialog( "open" );  //Debe ir antes del selectmenu por un bug de jQuery
				$("#cmbLineaD").selectmenu();
				$("#cmbTipoD").selectmenu();
				$("#cmbLineaD").selectmenu("refresh");
				$("#cmbTipoD").selectmenu("refresh");
			}else{
				swal("Error","Error al editar producto", "Warning");
				$("#dlgEdProductos").dialog( "close" );
			}
			
		}

	//Procesa la respuesta parcial del servidor y llena la tabla de productos
	function procesaProductosEncontrados(oDatos) {
		let oNodoFrm = $("#frmBuscarProd");
		let oNodoDiv = $("#resBuscarProd");
		let oTblBody = $("#tblBodyProds");
		let oCelCabPrecio = $("#tdPrecio");
		let oCeldaCve, oCeldaNombre, oCeldaLinea, oCeldaTipo, oCeldaDescripcion, oCeldaSabor, oCeldaImagen, oCeldaPrecio, oCelCabOpe, oBtnModif, oBtnElim;
		let sError = "";
		let oFmt = new Intl.NumberFormat('es-MX', {
			style: 'currency',
			currency: 'MXN',
			minimumFractionDigits: 2
		});

		try {
			if (oNodoFrm === null || oNodoDiv === null || oTblBody === null)
				sError = "Error en HTML";
			else {
				if (oDatos.success) {//todo ok				
					//Limpiar contenido de cuerpo de la tabla
					oTblBody.innerHTML = "";
					//Llena líneas
					oDatos.data.arrProds.forEach(function (elem) {
						oLinea = $("<tr>");
						oCeldaCve = $("<td>");
						oCeldaNombre = $("<td>");
						oCeldaLinea = $("<td>");
						oCeldaTipo = $("<td>");
						oCeldaDescripcion = $("<td>");
						oCeldaSabor = $("<td>")
						oCeldaImagen = $("<img>");
						oCeldaCve.text(elem.clave);
						oCeldaNombre.text(elem.nombre);
						oCeldaLinea.text(elem.linea);
						oCeldaTipo.text(elem.tipo);
						oCeldaDescripcion.text(elem.descripcion);
						oCeldaSabor.text(elem.sabor);
						oCeldaImagen.prop({
							src: "img/" + elem.imagen,
							alt: "imagen " + elem.nombre
						});
						oCeldaImagen.append(oCeldaImagen);
						oLinea.append(oCeldaCve, oCeldaNombre, oCeldaLinea, oCeldaTipo, oCeldaDescripcion, oCeldaSabor, oCeldaImagen);
						if (sessionStorage.getItem("sDescTipo") !== null &&
							sessionStorage.getItem("sDescTipo") !== "") {
							oCeldaPrecio = $("<td>");
							oCeldaPrecio.text(oFmt.format(elem.precio));
							oLinea.append(oCeldaPrecio);
							if (sessionStorage.getItem("sDescTipo") === "Administrador") {
								oCelCabOpe = $("<td>");
								if (elem.activo) {
									oBtnModif = $("<input>");
									oBtnModif.prop({
										type: "button",
										value: "Modificar",
										id: "Mod" + elem.clave
									});
									oBtnModif.button();
									oBtnModif.click(function () {
										muestraDlgEdProductos("m",
											$(this).prop("id").substr(3));//Ya nos acordamos para qué está xd
									});
									oCelCabOpe.append(oBtnModif);
									oBtnElim = $("<input>");
									oBtnElim.prop({
										type: "button",
										value: "Eliminar",
										id: "Elim" + elem.clave
									});
									oBtnElim.button();
									oBtnElim.click(function () {
										muestraDlgEdProductos("b",
											$(this).prop("id").substr(4));
									});
									oCelCabOpe.append(oBtnElim);
								} else {
									oCelCabOpe.text(" ");
								}
								oLinea.append(oCelCabOpe);
							}
						}
						oTblBody.append(oLinea);
					});
					//Para ocultar tablas
					oNodoFrm.css("display", "none");
					oNodoDiv.css("display", "block");
					if (sessionStorage.getItem("sDescTipo") === null ||
						sessionStorage.getItem("sDescTipo") === "") {
						oCelCabPrecio.css("display", "none");
						oCelCabOpe.css("display", "none");
						$('#btnCrearProducto').css("display", "none");
					} else {
						oCelCabPrecio.css("display", "table-cell");
						if (sessionStorage.getItem("sDescTipo") === "Administrador") {
							oCelCabOpe.css("display", "table-cell");
							$('#btnCrearProducto').css("display", "block");
						}
						else {
							oCelCabOpe.css("display", "none");
							$('#btnCrearProducto').css("display", "none");
						}
					}
				} else {
					sError = oDatos.status;
				}
			}
		} catch (error) {
			console.log(error.message);
			sError = "Error al procesar respuesta del servidor";
		}
		if (sError !== "")
			swal("Error", sError, "warning");
	}

});

function getLinea() {
	return '<option value="0">Todos</option>' +
		'<option value="1">Pastel</option>' +
		'<option value="2">Galletas</option>' +
		'<option value="3">Gelatinas</option>' +
		'<option value="4">Panquesitos</option>';
}

function getTipo() {
	return '<option value="0">Todos</option>' +
		'<option value="1">Normal</option>' +
		'<option value="2">Dietético</option>' +
		'<option value="3">Diabético</option>' +
		'<option value="4">Vegano</option>';
}

