/*
Archivo:  ctrlBienvenido.js
Objetivo: presenta contenido de la página de bienvenida
Autor:    BAOZ
*/
Ext.require([
	'Ext.plugin.Viewport'
]);
Ext.onReady(function () {
	let sNom = sessionStorage.getItem('nombreFirmado');
	let sTipo = sessionStorage.getItem('tipoFirmado');
	Ext.get("sct1").setHtml(
		'<main id="main-content">' +
		'<section>' +
		'<header>' +
		'<div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">' +
		'<h2 class="text-primary font-secondary">Bienvenido ' + sNom + '</h2>' +
		'</div>' +
		'</header>' +
		'<div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">' +
		'<h1 class="text-primary font-secondary">Est&aacute;s firmado como ' + sTipo + '</h1>' +
		'</div>' +
		'</section>' +
		'</main>'

	);
});