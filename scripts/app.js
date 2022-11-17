/**
* Archivo:  app.js
* Objetivo: configuración de la aplicación únicamente; 
*           en este caso incluye ruteo, material y mensajes 
* Autor: BAOZ
**/
	//Se incluye el módulo de ruteo
	var app = angular.module('aplic', ['ngRoute', 'ngMaterial', 'ngMessages']);
	
	app.config(function($routeProvider){
		$routeProvider
			.when('/', {
				templateUrl: 'views/home.html',
				controller:'HomeController'
			})
			.when('/inicio', {
				templateUrl: 'views/inicio.html',
				controller:'InicioController'
			})
			.when('/catalogo', {
				templateUrl: 'views/catalogo.html',
				controller:'CatalogoController'
			})
			.when('/clientes', {
				templateUrl: 'views/clientes.html'
			})
			.when('/envios', {
				templateUrl: 'views/envios.html'
			})
			.when('/empleados', {
				templateUrl: 'views/empleados.html'
			})
			.when('/regimenes', {
				templateUrl: 'views/regimenes.html'
			})
			.when('/usos', {
				templateUrl: 'views/usos.html'
			})
			.otherwise({
				redirectTo: '/'
			});
	});
	
	app.config(function($mdThemingProvider) {
		//$mdThemingProvider.disableTheming();
		$mdThemingProvider.theme('default')
			.primaryPalette('orange',{
				'default': 'A700',
				'hue-1': '700',
				'hue-2': '800',
				'hue-3': '900'
			})
			.accentPalette('lime',{
				'default':'600'
			})
			.warnPalette('amber')
			.backgroundPalette('grey');
	});

	app.controller("ctrl", function ($scope, $location, $http) {
		//Define atributos que se utilizan en varios puntos, como el menú por ejemplo
		$scope.bFirmado = false;
		$scope.sClsOpcCajero = "menu_inhab";
		$scope.sClsOpcAlmacenista = "menu_inhab";
		$scope.sClsOpcAdmor = "menu_inhab";
		$scope.sClsMnuSalir = "menu_inhab";	
		sessionStorage.setItem('nombreFirmado', '');
		sessionStorage.setItem('tipoFirmado', '');
		
		//Define funciones que se invocan en los menús
		$scope.eligeNavInicio = () =>{
			if ($scope.bFirmado)
				$location.path( "/inicio" );
			else
				$location.path( "/" );
		};
		
		$scope.eligeNavCatalogo = () =>{
			$location.path( "/catalogo" );
		};
		
		$scope.eligeNavCltes = () =>{
			if ($scope.bFirmado)
				$location.path( "/clientes" );
			else
				$location.path( "/" );
		};
		
		$scope.eligeNavEnvios = () =>{
			if ($scope.bFirmado)
				$location.path( "/envios" );
			else
				$location.path( "/" );
		};
		
		$scope.eligeNavEmpleados = () =>{
			if ($scope.bFirmado)
				$location.path("/empleados");
			else
				$location.path( "/" );
		};
		
		$scope.eligeNavRegimenes = () =>{
			if ($scope.bFirmado)
				$location.path("/regimenes");
			else
				$location.path( "/" );
		};
		
		$scope.eligeNavUsos = () =>{
			if ($scope.bFirmado)
				$location.path("/usos");
			else
				$location.path( "/" );
		};
		
		$scope.eligeNavSalir = () =>{
			if ($scope.bFirmado)
				$scope.salir();
		};
		
		//Define función para terminar la sesión
		$scope.salir = ()=>{
			$scope.bFirmado = false;
			sessionStorage.setItem('nombreFirmado', '');
			sessionStorage.setItem('tipoFirmado', '');
			$http({
				method : "POST",
				url : "control/ctrlLogout.php"
			}).then(function (response){
				$scope.setMenu();
				$location.url("/index.html");
			});
		};
		
		//Define función para afectar indirectamente los menús
		$scope.setMenu=()=>{
			$scope.sClsOpcCajero = "menu_inhab";
			$scope.sClsOpcAlmacenista = "menu_inhab";
			$scope.sClsOpcAdmor = "menu_inhab";
			$scope.sClsMnuSalir = "menu_inhab";	
			sTipoFirmado = "";
			if (sessionStorage.getItem("tipoFirmado")){
				$scope.bFirmado = true;
				$scope.sClsMnuSalir = "menu";
				sTipoFirmado = sessionStorage.getItem("tipoFirmado");
				switch(sTipoFirmado){
					case 'Administrador': $scope.sClsOpcAdmor = 'menu';
										  break;
					case 'Almacenista': $scope.sClsOpcAlmacenista = 'menu';
										  break;
					case 'Cajero': $scope.sClsOpcCajero = 'menu';
										  break;
				}
			}else{
				$scope.bFirmado = false;
			}
		}
	});