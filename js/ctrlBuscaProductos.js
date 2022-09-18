/*
Archivo:  ctrlBuscaProductos.js
Objetivo: código de JavaScript para realizar llamada parcial a PHP para consultar 
		  productos 
Autor:    Pasteleria
*/

function llenaFiltros(){
let oCmb = document.getElementById("cmbTipo");
let oCmbFiltro = document.getElementById("cmbFiltro");
	if (oCmb===null || oCmbFiltro===null){
		alert('Error de referencias');
	}else{
		//Limpia combo de filtros y sólo deja la opción por omisión
		oCmbFiltro.innerHTML = '<option value="">Todos</option>';
		//Dependiendo del tipo de producto, llena el combo de filtros
		//Podrían pedirse al servidor para evitar problemas de consistencia de datos.
		
		oCmbFiltro.innerHTML = oCmbFiltro.innerHTML+
						'<option value="1">Normal</option>'+
						'<option value="2">Dietético</option>'+
						'<option value="3">Diabético</option>'+
						'<option value="4">Vegano</option>';
	}
}

function llamaBusqueda(){
let urlLlamada = "control/ctrlBuscaProducto.php";
let oCmb = document.getElementById("cmbTipo");
let oCmbFiltro = document.getElementById("cmbFiltro");
let sQueryString = "";
	if (oCmb===null || oCmb.selectedIndex===0 || oCmbFiltro===null){
		alert("Faltan datos para buscar");
	}else{
		sQueryString = "?cmbTipo="+oCmb.options[oCmb.selectedIndex].value +
						"&cmbFiltro="+
						(oCmbFiltro.selectedIndex===0?"":oCmbFiltro.options[oCmbFiltro.selectedIndex].value);
		fetch(urlLlamada+sQueryString)
		.then( (response) => {return response.json();})
		.then( (datosConvertidos) => {
			procesaProductosEncontrados(datosConvertidos);
		})
		.catch( (error) => {
			alert("Error al realizar la llamada");
			console.error(error);
		});
	}
}

//Procesa la respuesta parcial del servidor y llena la tabla de productos
function procesaProductosEncontrados(oDatos){
let oNodoFrm = document.getElementById("frmBuscarProd");
let oNodoDiv = document.getElementById("resBuscarProd");
let oTblBody = document.getElementById("tblBodyProds"); 
let oCelCabPrecio = document.getElementById("tdPrecio");
let oCeldaCve, oCeldaNombre, oCeldaLinea, oCeldaTipo, oCeldaDescripcion, oCeldaSabor, oCeldaImagen, oCeldaPrecio;
let sError = "";
let oFmt = new Intl.NumberFormat('es-MX', {
		style: 'currency',
		currency: 'MXN',
		minimumFractionDigits: 2
	});
	
	try{
		if (oNodoFrm === null || oNodoDiv === null || oTblBody === null)
			sError = "Error en HTML";
		else{
			if (oDatos.success){//todo ok				
				//Limpiar contenido de cuerpo de la tabla
				oTblBody.innerHTML = "";
				
				//Llena líneas
				oDatos.data.arrProds.forEach(function(elem){
					//Se crean las celdas
					oLinea = oTblBody.insertRow(-1);
					oCeldaCve = oLinea.insertCell(-1);
					oCeldaNombre = oLinea.insertCell(-1);
					oCeldaLinea = oLinea.insertCell(-1);
					oCeldaTipo = oLinea.insertCell(-1);
					oCeldaDescripcion = oLinea.insertCell(-1);
					oCeldaSabor = oLinea.insertCell(-1);
					oCeldaImagen = oLinea.insertCell(-1);

					//Se llenan los valores
					oCeldaCve.innerHTML = elem.clave;
					oCeldaNombre.innerHTML = elem.nombre;
					oCeldaLinea.innerHTML = elem.linea;
					oCeldaTipo.innerHTML = elem.tipo;
					oCeldaDescripcion.innerHTML = elem.descripcion;
					oCeldaSabor.innerHTML = elem.sabor;
					oCeldaImagen.appendChild(document.createElement("img"));
					oCeldaImagen.firstChild.src = "imgs/"+elem.imagen;
					oCeldaImagen.firstChild.alt = "imagen "+elem.nombre;
					
					// Si esta registrado
					if (sessionStorage.getItem("sDescTipo")!==null && sessionStorage.getItem("sDescTipo")!==""){
						oCeldaPrecio = oLinea.insertCell(-1);
						oCeldaPrecio.innerHTML = oFmt.format(elem.precio);
					}
				});
				
				//Ocultar formularios y mostrar tabla*/
				oNodoFrm.style.display = "none";
				oNodoDiv.style.display = "block";
				if (sessionStorage.getItem("sDescTipo") === null ||
					sessionStorage.getItem("sDescTipo") === ""){
					oCelCabPrecio.style.display = "none";
				}else{
					oCelCabPrecio.style.display = "table-cell";
				}
			}else{
				sError = oDatos.status;
			}
		}
	}catch(error){
		console.log(error.message);
		sError = "Error al procesar respuesta del servidor";
	}
	if (sError !== "")
		alert(sError);
}

function configura(){
let frm = document.getElementById('frmBuscarProd');	
let btn = document.getElementById('btnBuscar');	
let oCmb = document.getElementById("cmbTipo");
	if (frm !== null && btn !== null && oCmb !== null){
		frm.addEventListener("submit", 
			function(evt){
				evt.preventDefault();
			}, 
			false);
		btn.addEventListener("click", llamaBusqueda, false);
		oCmb.addEventListener("change", llenaFiltros, false);
	}
	else{
		alert('Error de referencias');
	}
}

//Esta línea se ejecutará una vez que se haya terminado de formar el DOM
if( document.readyState !== 'loading' ){
	configura();
}
