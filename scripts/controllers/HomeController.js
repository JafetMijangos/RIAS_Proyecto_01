/**
* Archivo: HomeController.js
* Objetivo: controlador para la pantalla inicial (home.html, tiene formulario para login)
* Autor: BAOZ
**/

//Definir controlador
app.controller('HomeController', function ($scope, $http) {
	$scope.bProcesando = false;
	$scope.sCorreoUsu = "";
	$scope.sPwd = "";
	$scope.bFirmado = false;
	$scope.sNombreFirmado = "";
	$scope.sTipoFirmado = "";
	$scope.ingresar = function () {
		$scope.bProcesando = true;
		$http({
			method: 'POST',
			data: 'txtCorreoUsu=' + $scope.sCorreoUsu + '&txtPwd=' + $scope.sPwd,
			url: 'control/ctrlLogin.php',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		}).then(function (response) {
			let datos = angular.fromJson(response.data);
			if (datos.success) {
				$scope.bFirmado = true;
				$scope.sNombreFirmado = datos.data.sNombreCompleto;
				$scope.sTipoFirmado = datos.data.sDescTipo;
				sessionStorage.setItem("nombreFirmado", $scope.sNombreFirmado);
				sessionStorage.setItem("tipoFirmado", $scope.sTipoFirmado);
				$scope.setMenu();
			} else {
				alert(datos.status);
			}
		}).catch(function (status) {
			console.log(status);
			alert('Error al llamar al servidor');
		}).finally(function () {
			$scope.bProcesando = false;
		});
	};

});