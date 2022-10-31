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
    //Las dejo por si las dudas
    Ext.get("sct1").setHtml(
        '<main id="main-content">' +
        '<section>' +
        '<header>' +
        '<div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">' +
        '<h1 class="text-primary font-secondary">EN CONSTRUCCI&Oacute;N, disculpe las molestias</h1>' +
        '</div>' +
        '</header>' +
        '</section>' +
        '</main>'

    );
});