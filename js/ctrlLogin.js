/*
Archivo:  ctrlLogin.js
Objetivo: código de JavaScript para realizar login mediante llamada parcial a PHP
Autor:    Pasteleria
*/

//Si pasa por aquí es que se encuentra en index.php y no hay sesión todavía
sessionStorage.clear();

//Configura y lanza la llamada parcial al servidor
function llamaLogin(){
let urlLlamada = "control/ctrlLogin.php";
let txtClave = document.getElementById("txtCorreoUsu");
let txtPwd = document.getElementById("txtPwd");
let datosFrm = "";
	if (txtClave===null || txtPwd===null ||
		txtClave.value.trim()==="" || txtPwd.value.trim()===""){
		alert("Faltan datos para el ingreso");
	}else{
		datosFrm = "txtCorreoUsu="+txtClave.value+"&txtPwd="+txtPwd.value;
		fetch(urlLlamada, { 
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded"
			},
			body: datosFrm
		})
		.then( (response) => {return response.json();})
		.then( (datosConvertidos) => {
			procesa(datosConvertidos);
		})
		.catch( (error) => {
			errorDetectado(error);
		});
	}
}

function procesa(oDatos){
let oNodoFrm = document.getElementById("frmLogin");
let oNodoDiv = document.getElementById("divBienvenido");
let oNodoNombre = document.getElementById("paraNombre"); 
let oNodoTipo = document.getElementById("paraTipo"); 
let sError = "";
	try{
		if (oNodoFrm === null || oNodoDiv === null ||
			oNodoNombre === null || oNodoTipo === null){
			sError = "Error en HTML";	
		}else{
			if (oDatos.success){
				//Colocar nombre y tipo
				oNodoNombre.innerHTML = oDatos.data.sNombreCompleto;
				oNodoTipo.innerHTML = oDatos.data.sDescTipo;
				
				//Modificar menús
				document.getElementById("mnuInicio").href = "inicio.php";
				document.getElementById("mnuSalir").className = "menu nav-item nav-link";
				
				if (oDatos.data.sDescTipo === "Administrador"){
					document.getElementById("mnuGesP").className = "menu nav-item nav-link";
					document.getElementById("mnuReg").className = "menu_inhab";
				}else if(oDatos.data.sDescTipo === "Cliente"){
					document.getElementById("mnuReg").className = "menu_inhab";
					document.getElementById("mnuCompra").className = "menu nav-item nav-link";
				}
				
				//Ocultar formulario y mostrar bienvenida*/
				oNodoFrm.style.display = "none";
				oNodoDiv.style.display = "block";
				
				//Iniciar sesión
				sessionStorage.setItem("sDescTipo", oDatos.data.sDescTipo);
			}else{
				sError = oDatos.status;
			}
		}
	}catch(error){
		console.log(error.message);
		sError = "Error al procesar respuesta del servidor";
	}
	if (sError != "")
		alert(sError);
}

function errorDetectado(error){
	alert("Error al realizar la llamada");
	console.error(error);
}

function configura(){
	console.log("dentro");
let frm = document.getElementById('frmLogin');	
let btn = document.getElementById('btnEnviar');	
	if (frm !== null && btn !== null){
		frm.addEventListener("submit", 
			function(evt){
				evt.preventDefault();
			}, 
			false);
		btn.addEventListener("click", llamaLogin, false);
	}
	else{
		alert('Error de referencias');
	}
}

//Esta línea se ejecutará una vez que se haya terminado de formar el DOM
if( document.readyState !== 'loading' ){
	configura();
}


