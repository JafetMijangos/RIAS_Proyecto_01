/* 
 * Archivo:  CatalogoController.js
 * Objetivo: controlador AngularJS para consultar/editar catálogo
 * Autor: Pasteles
 */	
	app.controller('CatalogoController', function($scope, $http) {
		$scope.bProcesando=false;
		//Relacionados con búsqueda general
		$scope.bTablaAreaLlena=false;
		$scope.bConsulta = true;

		$scope.cmbLinea = "";
		$scope.cmbTipo = "";
		$scope.arrProductos = [];

		//Relacionados con edición
		$scope.bEditable = sessionStorage.getItem("tipoFirmado")==='Administrador';
		$scope.sTitOpe = "";
		$scope.sOpe = "";
		$scope.bDatosSoloLectura = true;
		$scope.cmbLineaD="";
		$scope.cmbTipoD="";
		$scope.productos = {};
			
		$scope.buscaProductos = ()=>{
			if ($scope.cmbLinea === "")
				alert("Faltan datos");
			else{
				$scope.bProcesando=true;
				$scope.arrProductos = [];
				//Los valores vacíos no los envía por optimización en caso de GET
				$http({
					method: "get",
					url : "control/ctrlBuscaProducto.php?cmbLinea="
					+$scope.cmbLinea+"&cmbTipo="+$scope.cmbTipo
				}).then(function (response){
					let datos = angular.fromJson(response);
					if (datos.data.success){
						$scope.arrProductos = datos.data.data.arrProds;
						$scope.bTablaAreaLlena = true;
					}else{
						alert(datos.data.status);
					}
				}).catch(function (status){
					console.log(status);
					alert('Error al llamar al servidor');
				}).finally(function (){
					$scope.bProcesando=false;
				});
			}
		};
		
		//Función para mostrar elementos de edición
		$scope.mostrarEdicion=function(sOpe, nCve){
			$scope.bDatosSoloLectura = false;
			//Configurar título
			switch(sOpe){
				case "a": $scope.sTitOpe = "Crear ";
						  break;
				case "b": $scope.sTitOpe = "Desactivar ";
						  $scope.bDatosSoloLectura = true;
						  break;
				case "m": $scope.sTitOpe = "Modificar ";
						  break;
			}
			
			
			$scope.sOpe = sOpe;
			//Limpiar datos
			$scope.productos = {
				clave: -1, 
				nombre:"", 
				cmbLineaD:"",
				cmbTipoD:"",
				txtDescripcion: "",
				txtSabor:"",
				txtImg:"",
				precio:0
				
			};
			angular.element(document.querySelector('#txtImg')).val(null);
			$scope.frmEditaProductos.$setUntouched();
			$scope.frmEditaProductos.$setPristine();
			
			//Si es nueva, sólo mostrar edición; de otro modo, es necesario buscar datos
			if (sOpe === "a"){
				$scope.bConsulta = false;
			}else{
				//Hacer llamada para buscar 
				$http({
					method: "get",
					params: {txtCve: nCve},
					url : "control/ctrlBuscarUnProducto.php"
				}).then(function (response){
					let datos = angular.fromJson(response.data);
					if (datos.success){
						$scope.productos = datos.data;
						$scope.productos.imagen="";
						$scope.bConsulta = false;
					}else{
						alert(datos.status);
					}
				}).catch(function (status){
					console.log(status);
					alert('Error al llamar al servidor');
				}).finally(function (){
					$scope.bProcesando=false;
				});
			}
		}
		
		$scope.guardarProductos = ()=>{
		let oFrmDatos = new FormData();
			//La validación se hace en HTML5, aquí llega si todo ok
			
			//Usa FormData para el envío del archivo
			oFrmDatos.append("cmbLinea", $scope.cmbLinea);
			oFrmDatos.append("txtCve", $scope.productos.clave);
			oFrmDatos.append("txtOpe", $scope.sOpe);
			oFrmDatos.append("txtNom", $scope.productos.nombre);
			oFrmDatos.append("cmbLineaD", $scope.productos.cmbLineaD);
			oFrmDatos.append("cmbTipoD", $scope.productos.cmbTipoD);
			oFrmDatos.append("txtDescripcion", $scope.productos.txtDescripcion);
			oFrmDatos.append("txtSabor", $scope.productos.txtSabor);
			oFrmDatos.append("txtImg", angular.element(document.querySelector("#txtImg"))[0].files[0]);
			oFrmDatos.append("txtPrecio", $scope.productos.precio);
			
			//En el envío, se ajusta 
			$http({
				url : "control/ctrlGestionarProducto.php",
				method : "POST",
				headers: {"Content-Type": undefined }, 
				data: oFrmDatos
			}).then(function (response){
				let datos = angular.fromJson(response.data);
				if (datos.success){
					alert("Guardado");
					$scope.buscaProductos();
					$scope.productos = {};
					$scope.frmEditaProductos.$setUntouched();
					$scope.frmEditaProductos.$setPristine();
					$scope.bConsulta = true;
				}else{
					alert(datos.status);
				}
			}).catch(function (status){
				console.log(status);
				alert('Error al llamar al servidor');
			}).finally(function (){
				$scope.bProcesando=false;
			});
		}
		
		$scope.cancelarEdicion = ()=>{
			$scope.bConsulta = true;
		}
	});