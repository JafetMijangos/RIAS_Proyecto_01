/**
* Archivo:  app.js
* Objetivo: configuración de la aplicación únicamente; 
*           en este caso incluye ruteo, material y mensajes 
* Autor: Equipo panecillo
**/
//Se incluye el módulo de ruteo
var app = angular.module('aplic', ['ngRoute', 'ngMaterial', 'ngMessages']);

app.config(function ($routeProvider) {
	$routeProvider
		.when('/', {
			templateUrl: 'views/home.html',
			controller: 'HomeController'
		})
		.when('/inicio', {
			templateUrl: 'views/inicio.html',
			controller: 'InicioController'
		})
		.when('/catalogo', {
			templateUrl: 'views/catalogo.html',
			controller: 'CatalogoController'
		})
		.when('/clientesReg', {
			templateUrl: 'views/clienteReg.html'
		})
		.when('/comprar', {
			templateUrl: 'views/comprar.html'
		})
		.when('/productos', {
			templateUrl: 'views/productos.html'
		})
		.otherwise({
			redirectTo: '/'
		});
});

app.config(function ($mdThemingProvider) {
	//$mdThemingProvider.disableTheming();
	$mdThemingProvider.theme('default')
		.primaryPalette('orange', {
			'default': 'A700',
			'hue-1': '700',
			'hue-2': '800',
			'hue-3': '900'
		})
		.accentPalette('lime', {
			'default': '600'
		})
		.warnPalette('amber')
		.backgroundPalette('grey');
});

app.controller("ctrl", function ($scope, $location, $http) {
	//Define atributos que se utilizan en varios puntos, como el menú por ejemplo
	$scope.bFirmado = false;
	$scope.sClsOpcCliente = "menu_inhab";
	$scope.sClsOpcAdmor = "menu_inhab";
	$scope.sClsMnuSalir = "menu_inhab";
	sessionStorage.setItem('nombreFirmado', '');
	sessionStorage.setItem('tipoFirmado', '');

	//Define funciones que se invocan en los menús
	$scope.eligeNavInicio = () => {
		if ($scope.bFirmado)
			$location.path("/inicio");
		else
			$location.path("/");
	};

	$scope.eligeNavCatalogo = () => {
		$location.path("/catalogo");
	};

	$scope.eligeNavCltes = () => {
			$location.path("/clientesReg");
	};

	$scope.eligeNavComprar = () => {
		if ($scope.bFirmado)
			$location.path("/comprar");
		else
			$location.path("/");
	};

	$scope.eligeNavProductos = () => {
		if ($scope.bFirmado)
			$location.path("/productos");
		else
			$location.path("/");
	};

	$scope.eligeNavSalir = () => {
		if ($scope.bFirmado)
			$scope.salir();
	};

	//Define función para terminar la sesión
	$scope.salir = () => {
		$scope.bFirmado = false;
		sessionStorage.setItem('nombreFirmado', '');
		sessionStorage.setItem('tipoFirmado', '');
		$http({
			method: "POST",
			url: "control/ctrlLogout.php"
		}).then(function (response) {
			$scope.setMenu();
			$location.url("/index.html");
		});
	};

	//Define función para afectar indirectamente los menús
	$scope.setMenu = () => {
	/*	$scope.sClsOpcCajero = "menu_inhab";
		$scope.sClsOpcAlmacenista = "menu_inhab";*/
		$scope.OculREg = "menu";
 		$scope.sClsOpcAdmor = "menu_inhab";
		$scope.sClsMnuSalir = "menu_inhab";
		$scope.sClsOpcCliente = "menu_inhab";
		sTipoFirmado = "";
		if (sessionStorage.getItem("tipoFirmado")) {
			$scope.bFirmado = true;
			$scope.OculREg = "menu_inhab";
			$scope.sClsMnuSalir = "menu";
			sTipoFirmado = sessionStorage.getItem("tipoFirmado");
			switch (sTipoFirmado) {
				case 'Administrador': $scope.sClsOpcAdmor = 'menu';
					break;
				case 'Cliente': $scope.sClsOpcCliente = 'menu';
					break;
				/*case 'Cajero': $scope.sClsOpcCajero = 'menu';
					break;*/
			}
		} else {
			$scope.bFirmado = false;
		}
	}
});