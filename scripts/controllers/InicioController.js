/* 
 * Archivo:  InicioController.js
 * Objetivo: controlador AngularJS para mostrar datos de bienvenida
 * Autor: BAOZ
 */	
	app.controller('InicioController', function($scope) {
		/*Variables para el saludo*/
		$scope.sNombreFirmado =sessionStorage.getItem("nombreFirmado");
		$scope.sTipoFirmado = sessionStorage.getItem("tipoFirmado");
	});