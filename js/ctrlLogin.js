/*
Archivo:  ctrlLogin.js
Objetivo: presenta formulario ExtJS para login, realiza envío parcial,
		  espera JSON como respuesta
Autor:    BAOZ
*/
Ext.require([
	'Ext.plugin.Viewport'
]);
Ext.onReady(function () {
	//Limpia la sesión
	sessionStorage.setItem('nombreFirmado', '');
	sessionStorage.setItem('tipoFirmado', '');

	Ext.create('Ext.form.Panel', {
		title: 'Ingresar al Sistema',
		bodyPadding: 5,
		width: '100%',
		url: "control/ctrlLogin.php",
		standardSubmit: false, //para request parcial
		defaultType: 'textfield',
		items: [
			{
				fieldLabel: 'Correo',
				vtype: 'email',
				name: 'txtCorreoUsu',
				allowBlank: false
			},
			{
				fieldLabel: 'Contrase&ntilde;a', //no funciona el tipo password en CLASSIC
				name: 'txtPwd',
				allowBlank: false,
				inputType: 'password'
			}],
		buttons: [{
			text: 'Enviar',
			handler: function () {
				var frm = this.up('form').getForm();
				if (frm.isValid()) {
					// Envío de forma parcial por la configuración inicial
					frm.submit({
						success: function (form, action) {
							//Guarda información de sesión en cliente
							sessionStorage.setItem('nombreFirmado',
								action.result.data.sNombreCompleto);
							sessionStorage.setItem('tipoFirmado',
								action.result.data.sDescTipo);
							//Cambia contenido de la pantalla				
							Ext.get("sct1").setHtml(
								'<header>' +
								'	<h3 class="text-primary font-secondary">Bienvenido</h3>' +
								'<div id="divBienvenido" >' +
								'<h1 class="text-primary font-secondary">Hola ' + action.result.data.sNombreCompleto + '</h1>' +
								'<h1 class="text-primary font-secondary">Est&aacute;s firmado como ' + action.result.data.sDescTipo + '</h1>' +
								'</div>' +
								'</div>');
							//Cambia la dirección del menú Inicio
							Ext.get("mnuInicio").set(
								{ href: "bienvenido.php" });
							//Cambia el estilo del menú Salir
							Ext.get("mnuSalir").set(
								{ cls: "menu" });
							//Cambia los estilos de los menús por perfil
							Ext.get("mnuCltes").set(
								{
									cls:
										(action.result.data.sDescTipo === 'Cajero' ? " menu" : " menu_inhab")
								});
							Ext.get("mnuEnvios").set(
								{
									cls:
										(action.result.data.sDescTipo === 'Almacenista' ? " menu" : " menu_inhab")
								});
							Ext.get("menuEmp").set(
								{
									cls:
										(action.result.data.sDescTipo === 'Administrador' ? " menu" : " menu_inhab")
								});
							Ext.get("mnuReg").set(
								{
									cls:
										(action.result.data.sDescTipo === 'Administrador' ? " menu" : " menu_inhab")
								});
							Ext.get("mnuUsos").set(
								{
									cls:
										(action.result.data.sDescTipo === 'Administrador' ? " menu" : " menu_inhab")
								});
						},
						failure: function (form, action) {
							Ext.Msg.alert('Error',
								action.result ? action.result.status : 'Sin respuesta');
						}
					});
				}
			}
		}],
		renderTo: Ext.get('sct1')
	});
});
