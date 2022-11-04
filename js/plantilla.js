/*
Archivo: plantilla.js
Objetivo: arma el HTML de la página como una plantilla
Autor: BAOZ
*/
Ext.require([
	'Ext.plugin.Viewport'
]);
var sNomFirm = (sessionStorage.getItem('nombreFirmado') === null ? "" : sessionStorage.getItem('nombreFirmado'));
var sTipoFirm = (sessionStorage.getItem('tipoFirmado') === null ? "" : sessionStorage.getItem('tipoFirmado'));
var sClsMnAdmor = (sTipoFirm === 'Administrador' ? 'menu' : 'menu_inhab');
var sClsMnCliente = (sTipoFirm === 'Cliente' ? 'menu' : 'menu_inhab' );
var sClsMnCliRe = (sTipoFirm === '' ?   'menu' : 'menu_inhab' );
var sClsMnSalir = (sTipoFirm === '' || sTipoFirm.length === 0 ? 'menu_inhab' : 'menu');



var cabecera = '<div class="container-fluid px-0 d-none d-lg-block">' +
	'<div class="row gx-0">' +
	'<div class="col-lg-4 text-center bg-secondary py-3">' +
	'<div class="d-inline-flex align-items-center justify-content-center">' +
	'<i class="bi bi-envelope fs-1 text-primary me-3"></i>' +
	'<div class="text-start">' +
	'<h6 class="text-uppercase mb-1">Nuestro Correo</h6>' +
	'<span>trigodeoro@gmail.com</span>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<div class="col-lg-4 text-center bg-primary border-inner py-3">' +
	'<div class="d-inline-flex align-items-center justify-content-center">' +
	'<a class="navbar-brand">' +
	'<h1 class="m-0 text-uppercase text-white"><i' +
	'class="fa fa-birthday-cake fs-1 text-dark me-3"></i>TRIGO DE ORO</h1>' +
	'</a>' +
	'</div>' +
	'</div>' +
	'<div class="col-lg-4 text-center bg-secondary py-3">' +
	'<div class="d-inline-flex align-items-center justify-content-center">' +
	'<i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>' +
	'<div class="text-start">' +
	'<h6 class="text-uppercase mb-1">Nuestro Tel&eacute;fono</h6>' +
	'<span>271-172-18-02</span>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'</div>';

var navega = '<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0">' +
	'<a href="index.html" class="navbar-brand d-block d-lg-none">' +
	'<h1 class="m-0 text-uppercase text-white"><i class="fa fa-birthday-cake fs-1 text-primary me-3"></i>Práctica 2</h1>' +
	'</a>' +
	'<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">' +
	'<span class="navbar-toggler-icon"></span>' +
	'</button>' +
	'<div class="collapse navbar-collapse" id="navbarCollapse">' +
	'<div class="navbar-nav ms-auto mx-lg-auto py-0">' +
	'<a href="'+(sNomFirm === ''?'index.php':'inicio.php')+'" class="menu nav-item nav-link" id="mnuInicio">Inicio</a>'+			
				'<a href="catalogo.php" class="menu nav-item nav-link" id="mnuCatalogo">Cat&aacute;logo de Productos</a>'+
				'<a href="clienteReg.php" class="'+sClsMnCliRe+' nav-item nav-link" id="mnuReg">Registrarse</a>'+
				'<a href="productos.php" class="'+sClsMnAdmor+' nav-item nav-link" id="mnuGesP">Gestionar Productos</a>'+
				'<a href="comprar.php" class="'+sClsMnCliente+' nav-item nav-link" id="mnuCompra">Comprar</a>'+
				'<a href="javascript:salir();" class="'+sClsMnSalir+' nav-item nav-link" id="mnuSalir">Salir</a>'+
            '</div>'+
	'</nav > ' +
	'<div class="container-fluid bg-primary py-5 mb-5 hero-header">' +
	'<div class="container py-5">' +
	'<div class="row justify-content-start">' +
	'<div class="col-lg-8 text-center text-lg-start">' +
	'<h1 class="font-secondary text-primary mb-4">Pasteleria trigo de Oro</h1>' +
	'<h1 class="display-1 text-uppercase text-white mb-4">¿Lo quieres?, ¡¡Lo tenemos!!</h1>' +
	'<h1 class="text-uppercase text-white">Los mejores pasteles de Orizaba</h1>' +
	'<figure>' +
	'<img src="img/amimacion.png" border="0" class="paraTraslado"/>' +
	'</figure>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'</div>';


var pral = '<main id="main-content">' +
	'<div class="forIng">' +
	'<section id="sct1">' +
	'<div class="col-lg-12 col-md-6 text-center">' +
	'</div>' +
	'</section>' +
	'</div>'+
	'</main>';

var pie = '<div class="container-fluid service position-relative px-5 mt-5" style="margin-bottom: 135px;">' +
	'<div class="container">' +
	'<div class="row g-5">' +
	'<div class="col-lg-4 col-md-6">' +
	'<div class="bg-primary border-inner text-center text-white p-5">' +
	'<h4 class="text-uppercase mb-3">Pasteles y Panquecitos</h4>' +
	'<p>Los mejores pasteles y panquesitos de orizaba,en diferentes presentaciones</p>' +
	'</div>' +
	'</div>' +
	'<div class="col-lg-4 col-md-6">' +
	'<div class="bg-primary border-inner text-center text-white p-5">' +
	'<h4 class="text-uppercase mb-3">Gelatinas</h4>' +
	'<p>Disfruta de nuestras gelatinas de diferentes colores y sabores</p>' +
	'</div>' +
	'</div>' +
	'<div class="col-lg-4 col-md-6">' +
	'<div class="bg-primary border-inner text-center text-white p-5">' +
	'<h4 class="text-uppercase mb-3">Galletas</h4>' +
	'<p>La mejor variedad de galletas de chocolate, chispas y diferentes sabores. </p>' +
	'</div>' +
	'</div>' +
	'<div class="col-lg-12 col-md-6 text-center">' +
	'<h1 class="text-uppercase text-light mb-4">Normales, diet&eacute;ticos, para diab&eacute;ticos y veganos</h1>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<br/>' +
	'<div class="container-fluid service position-relative px-5 mt-5" style="margin-bottom: 135px;">' +
	'<div class="container">' +
	'<link rel="stylesheet" href="https:use.fontawesome.com/releases/v5.3.1/css/all.css" integrity"xxx" crossorigin="anonymous">' +
	'<div class= "containerAnimacion">' +
	'<div class= "boton">' +
	'<h1 class="like">Like!!</h1>' +
	'<t class="fa fa fa-thumbs-up" aria-hidden="true"></t>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<div class="container-fluid py-5">' +
	'<div class="container">' +
	'<div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">' +
	'<h2 class="text-primary font-secondary">Pastelitos</h2>' +
	'<h1 class="display-4 text-uppercase">Nuestros integrantes</h1>' +
	'</div>' +
	'<div class="row g-5">' +
	'<div class="col-lg-4 col-md-6">' +
	'<div class="team-item">' +
	'<div class="position-relative overflow-hidden">' +
	'<img class="img-fluid w-100" src="img/jafet.jpeg" alt="">' +
	'<div class="team-overlay w-100 h-100 position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center">' +
	'<div class="d-flex align-items-center justify-content-start">' +
	'<a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<div class="bg-dark border-inner text-center p-4">' +
	'<h4 class="text-uppercase text-primary">Jafet M.</h4>' +
	'<p class="text-white m-0">Pastelero</p>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<div class="col-lg-4 col-md-6">' +
	'<div class="team-item">' +
	'<div class="position-relative overflow-hidden">' +
	'<img class="img-fluid w-100" src="img/moya.jpeg" alt="">' +
	'<div class="team-overlay w-100 h-100 position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center">' +
	'<div class="d-flex align-items-center justify-content-start">' +
	'<a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1" href="https://www.facebook.com/gerardo.iturribarriamoya/"><i class="fab fa-facebook-f fw-normal"></i></a>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<div class="bg-dark border-inner text-center p-4">' +
	'<h4 class="text-uppercase text-primary">Gerardo M.</h4>' +
	'<p class="text-white m-0">Pastelero</p>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<div class="col-lg-4 col-md-6">' +
	'<div class="team-item">' +
	'<div class="position-relative overflow-hidden">' +
	'<img class="img-fluid w-100" src="img/Arturito.jpeg" alt="">' +
	'<div class="team-overlay w-100 h-100 position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center">' +
	'<div class="d-flex align-items-center justify-content-start">' +
	'<a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1" href="https://www.facebook.com/arturo.ruizdominguez/"><i class="fab fa-facebook-f fw-normal"></i></a>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<div class="bg-dark border-inner text-center p-4">' +
	'<h4 class="text-uppercase text-primary">Arturito R.</h4>' +
	'<p class="text-white m-0">Pastelero</p>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<div class="col-lg-4 col-md-6">' +
	'<div class="team-item">' +
	'<div class="position-relative overflow-hidden">' +
	'<img class="img-fluid w-100" src="img/emiliano.jpeg" alt="">' +
	'<div class="team-overlay w-100 h-100 position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center">' +
	'<div class="d-flex align-items-center justify-content-start">' +
	'<a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<div class="bg-dark border-inner text-center p-4">' +
	'<h4 class="text-uppercase text-primary">Emily S.</h4>' +
	'<p class="text-white m-0">Pastelero</p>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<div class="col-lg-4 col-md-6">' +
	'<div class="team-item">' +
	'<div class="position-relative overflow-hidden">' +
	'<img class="img-fluid w-100" src="img/paty.jpg" alt="">' +
	'<div class="team-overlay w-100 h-100 position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center">' +
	'<div class="d-flex align-items-center justify-content-start">' +
	'<a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 mx-1" href="https://www.facebook.com/profile.php?id=100008691211747"><i class="fab fa-facebook-f fw-normal"></i></a>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<div class="bg-dark border-inner text-center p-4">' +
	'<h4 class="text-uppercase text-primary">Paty L.</h4>' +
	'<p class="text-white m-0">Pastelera</p>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<div class="container-fluid bg-img text-secondary" style="margin-top: 90px">' +
	'<div class="container">' +
	'<div class="row gx-5">' +
	'<div class="col-lg-4 col-md-6 mb-lg-n5">' +
	'<div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary border-inner p-4">' +
	'<a href="index.html" class="navbar-brand">' +
	'<h1 class="m-0 text-uppercase text-white"><i class="fa fa-birthday-cake fs-1 text-dark me-3"></i>PASTELES</h1>' +
	'</a>' +
	'<p class="mt-3">Nuestra pasteler&iacute;a se basa en brindar la mejor atenci&oacute;n y calidad' +
	'en nuestros productos, adem&aacute;s de que contamos con una extensa variedad para todos los gustos ' +
	'y estilos de vida.' +
	'</p>' +
	'</div>' +
	'</div>' +
	'<div class="col-lg-8 col-md-6">' +
	'<div class="row gx-5">' +
	'<div class="col-lg-4 col-md-12 pt-5 mb-5">' +
	'<h4 class="text-primary text-uppercase mb-4">Direcci&oacute;n</h4>' +
	'<div class="d-flex mb-2">' +
	'<i class="bi bi-geo-alt text-primary me-2"></i>' +
	'<p class="mb-0">Orizaba,Ver</p>' +
	'</div>' +
	'<div class="d-flex mb-2">' +
	'<i class="bi bi-envelope-open text-primary me-2"></i>' +
	'<p class="mb-0">trigodeoro@gmail.com</p>' +
	'</div>' +
	'<div class="d-flex mb-2">' +
	'<i class="bi bi-telephone text-primary me-2"></i>' +
	'<p class="mb-0">271-172-18-02</p>' +
	'</div>' +
	'</div>' +
	'<div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">' +
	'<h4 class="text-primary text-uppercase mb-4">Quick Links</h4>' +
	'<div class="d-flex flex-column justify-content-start">' +
	'<a class="text-secondary mb-2" ><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>' +
	'<a class="text-secondary mb-2" ><i class="bi bi-arrow-right text-primary me-2"></i>Cat&aacute;logo de Productos</a>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'</div>' +
	'<div class="container-fluid text-secondary py-4" style="background: #111111;">' +
	'<div class="container text-center">' +
	'<p class="mb-0">&copy; Derechos Reservados ' +
	'<br>Hecho por: Equipo panecillo ' +
	'</div>' +
	'</div>'
	;


Ext.application({
	name: 'Plantilla',
	launch: function () {
		Ext.create('Ext.container.Container', {
			renderTo: Ext.getBody(),
			fullscreen: true,
			html: cabecera + navega + pral + pie
		});
	}
});

function salir() {
	//Limpia la sesión y se va a logout
	sessionStorage.setItem('nombreFirmado', '');
	sessionStorage.setItem('tipoFirmado', '');
	window.location.href = "control/ctrlLogout.php";
}