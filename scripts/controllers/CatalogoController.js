/* 
 * Archivo:  CatalogoController.js
 * Objetivo: controlador AngularJS para consultar/editar catálogo
 * Autor: BAOZ
 */	
	app.controller('CatalogoController', function($scope, $http) {
		$scope.bProcesando=false;
		//Relacionados con búsqueda general
		$scope.bTablaAreaLlena=false;
		$scope.bConsulta = true;
		$scope.sTipo = "";
		$scope.sFiltro = "";
		$scope.arrFiltros = [];
		$scope.arrPlantas = [];
		//Relacionados con edición
		$scope.bEditable = sessionStorage.getItem("tipoFirmado")==='Administrador';
		$scope.sTitOpe = "";
		$scope.sOpe = "";
		$scope.bDatosSoloLectura = true;
		$scope.sNomOtros="";
		$scope.planta = {};
		
		$scope.cargaFiltros = ()=>{
			$scope.bProcesando=true;
			$scope.arrFiltros = [];
			if ($scope.sTipo === "1"){
				$scope.arrFiltros = [
					{cve: "c", descrip: "Chico"},
					{cve: "m", descrip: "Mediano"},
					{cve: "g", descrip: "Grande"}
				];
			}else if ($scope.sTipo === "2"){
				$scope.arrFiltros = [
					{cve: "1", descrip: "Sobre"},
					{cve: "2", descrip: "Bolsa"}
				];
			}
			$scope.sFiltro = "";
			$scope.bProcesando=false;
		}
			
		$scope.buscaPlantas = ()=>{
			if ($scope.sTipo === "")
				alert("Faltan datos");
			else{
				$scope.bProcesando=true;
				$scope.arrPlantas = [];
				//Los valores vacíos no los envía por optimización en caso de GET
				$http({
					method: "get",
					url : "control/ctrlBuscaPlantas.php?cmbFiltro="
					+$scope.sFiltro+"&cmbTipo="+$scope.sTipo
				}).then(function (response){
					let datos = angular.fromJson(response);
					if (datos.data.success){
						$scope.arrPlantas = datos.data.data.arrProds;
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
			if ($scope.sTipo==="1"){
				$scope.sTitOpe = $scope.sTitOpe + "Planta";
				$scope.sNomOtros="Tama\u00F1o";
			}
			else{
				$scope.sTitOpe = $scope.sTitOpe + "Semilla";
				$scope.sNomOtros="Presentaci\u00F3n";
			}
			
			$scope.sOpe = sOpe;
			//Limpiar datos
			$scope.planta = {
				clave: -1, 
				nombre:"", 
				esDeSombra:false,
				tieneFlores:false,
				cuidadosGenerales: "",
				otros:"",
				precio:0,
				imagen:""
			};
			angular.element(document.querySelector('#txtImg')).val(null);
			$scope.frmEditaPlanta.$setUntouched();
			$scope.frmEditaPlanta.$setPristine();
			
			//Si es nueva, sólo mostrar edición; de otro modo, es necesario buscar datos
			if (sOpe === "a"){
				$scope.bConsulta = false;
			}else{
				//Hacer llamada para buscar datos planta/semilla
				$http({
					method: "get",
					params: {cmbTipo:$scope.sTipo, txtCve: nCve},
					url : "control/ctrlBuscarUnaPlantaOrnato.php"
				}).then(function (response){
					let datos = angular.fromJson(response.data);
					if (datos.success){
						$scope.planta = datos.data;
						$scope.planta.imagen="";
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
		
		$scope.guardarPlanta = ()=>{
		let oFrmDatos = new FormData();
			//La validación se hace en HTML5, aquí llega si todo ok
			
			//Usa FormData para el envío del archivo
			oFrmDatos.append("cmbTipo", $scope.sTipo);
			oFrmDatos.append("txtCve", $scope.planta.clave);
			oFrmDatos.append("txtOpe", $scope.sOpe);
			oFrmDatos.append("txtNom", $scope.planta.nombre);
			oFrmDatos.append("cbSombra", $scope.planta.esDeSombra);
			oFrmDatos.append("cbFlores", $scope.planta.tieneFlores);
			oFrmDatos.append("txtCuida", $scope.planta.cuidadosGenerales);
			oFrmDatos.append("txtPrecio", $scope.planta.precio);
			oFrmDatos.append("txtImg", angular.element(document.querySelector("#txtImg"))[0].files[0]);
			oFrmDatos.append("cmbOtros", $scope.planta.otros);
			//En el envío, se ajusta 
			$http({
				url : "control/ctrlGestionarPlantaOrnato.php",
				method : "POST",
				headers: {"Content-Type": undefined }, 
				data: oFrmDatos
			}).then(function (response){
				let datos = angular.fromJson(response.data);
				if (datos.success){
					alert("Guardado");
					$scope.buscaPlantas();
					$scope.planta = {};
					$scope.frmEditaPlanta.$setUntouched();
					$scope.frmEditaPlanta.$setPristine();
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