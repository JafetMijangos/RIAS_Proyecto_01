/*
Archivo:  ctrlLogin.js
Objetivo: código de jQuery para realizar login mediante llamada parcial a PHP
Autor:    BAOZ
*/

//Si pasa por aquí es que se encuentra en index.php y no hay sesión todavía
sessionStorage.clear();

//Configurar botón
$().ready(() => {
	//Aspecto gráfico
	$('#btnEnviar').button();
	//Reacción al click
	$('#btnEnviar').click(function (event) {
		event.preventDefault();
		if ($("#txtCorreoUsu") === null || $("#txtPwd") === null ||
			$("#txtCorreoUsu").val().trim() === "" || $("#txtPwd").val().trim() === "") {
			swal("Error", "Faltan datos para el ingreso", "warning");

		} else {
			$.post({
				url: "control/ctrlLogin.php",
				data: { //Al ser post, se genera el equivalente a formulario
					txtCorreoUsu: $("#txtCorreoUsu").val(),
					txtPwd: $("#txtPwd").val()
				}
			})
				.done((oDatos) => {
					procesa(oDatos);
				})
				.fail(function (objResp, status, sError) {
					swal("Error", 'El servidor indica error ' + status, "warning");
					console.log(sError);
				})
				.always(function (objResp, status) {
					console.log("Llamada externa completada con situación = " + status);
				});
		}
	});
});

function procesa(oDatos) {
	let sError = "";
	try {
		if ($("#frmLogin") === null || $("#divBienvenido") === null ||
			$("#paraNombre") === null || $("#paraTipo") === null) {
			sError = "Error en HTML";
		} else {
			if (oDatos.success) {
				//Colocar nombre y tipo
				$("#paraNombre").text(oDatos.data.sNombreCompleto);
				$("#paraTipo").text(oDatos.data.sDescTipo);

				//Modificar menús
				$("#mnuInicio").attr("href", "inicio.php");
				$("#mnuSalir").attr("class", "menu nav-item nav-link");

				if (oDatos.data.sDescTipo === "Administrador") {
					$("#mnuGesP").attr("class", "menu nav-item nav-link");
					$("#mnuReg").attr("class", "menu_inhab");
				} else if (oDatos.data.sDescTipo === "Cliente") {
					$("#mnuReg").attr("class", "menu_inhab");
					$("#mnuCompra").attr("class", "menu nav-item nav-link");
				}

				//Ocultar formulario y mostrar bienvenida*/
				$("#frmLogin").css("display", "none");
				$("#divBienvenido").css("display", "block");

				//Iniciar sesión
				sessionStorage.setItem("sDescTipo", oDatos.data.sDescTipo);
			} else {
				sError = oDatos.status;
			}
		}
	} catch (error) {
		console.log(error.message);
		sError = "Error al procesar respuesta del servidor";
	}
	if (sError != "")
		swal("Error", sError, "warning");
}