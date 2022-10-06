/*
Archivo:  ctrlBuscaProductos.js
Objetivo: código de JavaScript para realizar llamada parcial a PHP para consultar 
		  productos 
Autor:    Pasteleria
*/
$().ready(() => {

	$('#btnBuscar').click(function (event) {
		llamaBusqueda();
	});

	$('#btnCrearProducto').click(function (event) {
		muestraDlgEdProductos("a", -1, $("#cmbTipo").val());
	});

	$("#frmEdProductos").submit(function (event) {
		let sErr = "";
		let oFrmDatos = new FormData();
		event.preventDefault();
		if ($("#txtOpe").val() === "b" ||
			$("#frmEdProductoss")[0].checkValidity()) {
			//Ya no verifica elementos porque, de no existir, no habría llegado a este punto
			oFrmDatos.append("cmbTipo", $("#txtTipo").val());
			oFrmDatos.append("txtCve", $("#txtCve").val());
			oFrmDatos.append("txtOpe", $("#txtOpe").val());
			oFrmDatos.append("txtNombre", $("#txtNombre").val());
			oFrmDatos.append("cmbLinea", $("#cmbLinea").val());
			oFrmDatos.append("cmbTipo", $("#cmbTipo").val());
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
						alert("Datos almacenados");
						$("#dlgEdProductos").dialog("close");
						$("#frmBuscarProd").css("display", "block");
						$("#resBuscarProd").css("display", "none");
					} else {
						alert("Error al almacenar: " + oDatos.status);
					}
				})
				.fail(function (objResp, status, sError) {
					swal("Error", "El servidor indica error al procesar", "warning");
					console.log(sError);
				})
		} //Los errores de validación los indicó HTML5
	});

//Agregar funcion muestraDlgProductos 238 de la profa
	function llamaBusqueda() {
		let urlLlamada = "control/ctrlBuscaProducto.php";
		let oCmb = document.getElementById("cmbTipo");
		let oCmbFiltro = document.getElementById("cmbFiltro");
		let sQueryString = "";
		if (oCmb === null || oCmbFiltro === null) {
			swal("Error", "Faltan datos para buscar", "warning");
		} else {
			//Se configura la llamada para pedir los datos
			sQueryString = "?cmbTipo=" + oCmb.options[oCmb.selectedIndex].value +
				"&cmbFiltro=" + oCmbFiltro.options[oCmbFiltro.selectedIndex].value;
			fetch(urlLlamada + sQueryString)
				.then((response) => { return response.json(); })
				.then((datosConvertidos) => {
					procesaProductosEncontrados(datosConvertidos);
				})
				.catch((error) => {
					swal("Error", "Error al realizar la llamada", "warning");
					console.error(error);
				});
		}
	}

	//Procesa la respuesta parcial del servidor y llena la tabla de productos
	function procesaProductosEncontrados(oDatos) {
		let oNodoFrm = $("#frmBuscarProd");
		let oNodoDiv = $("#resBuscarProd");
		let oTblBody = $("#tblBodyProds");
		let oCelCabPrecio = $("#tdPrecio");
		let oCeldaCve, oCeldaNombre, oCeldaLinea, oCeldaTipo, oCeldaDescripcion, oCeldaSabor, oCeldaImagen, oCeldaPrecio, oCeldaOpe, oBtnModif, oBtnElim;
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
								oCeldaOpe = $("<td>");
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
											$(this).prop("id").substr(3),
											$("#cmbTipo").val());//No nos acordamos para qué está xd
									});
									oCeldaOpe.append(oBtnModif);
									oBtnElim = $("<input>");
									oBtnElim.prop({
										type: "button",
										value: "Eliminar",
										id: "Elim" + elem.clave
									});
									oBtnElim.button();
									oBtnElim.click(function () {
										muestraDlgEdProductos("b",
											$(this).prop("id").substr(4),
											$("#cmbTipo").val());
									});
									oCeldaOpe.append(oBtnElim);
								} else {
									oCeldaOpe.text(" ");
								}
								oLinea.append(oCeldaOpe);
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
