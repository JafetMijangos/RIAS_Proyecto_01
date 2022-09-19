<?php
/*
Archivo:  index.php
Objetivo: ejemplo llamadas parciales externas con JS 
Autor:    BAOZ
*/
include_once("modelo/Empleado.php");
include_once("modelo/Cliente.php");
session_start();
include_once("header.html");
include_once("menu.php");
?>		<!-- ingresar Start -->
			<main id="main-content">
			
				<script src="js/ctrlLogin.js" async="true"></script>
				<section>
					<header>
					<div class="col-lg-12 col-md-6 text-center">
                        <h1 class="tituloN">Ingresar al Sistema</h1>
                    </div>
					</header>
					<div class="col-lg-12 col-md-6 text-center">
					<form id="frmLogin">
					<br/>
                        <br/>
						<br/>
                        <br/>
						<label class="text-primary text-uppercase mb-4" for="txtCorreoUsu">Correo</label> 
						<input class="form-control border-white p-3" type="email" id="txtCorreoUsu" required/>
						<br/>
						<br/>
						<label class="text-primary text-uppercase mb-4" for="txtPwd">Contrase&ntilde;a</label> 
						<input class="form-control border-white p-3" type="password" id="txtPwd" required/>
						<br/>
                        <br/>
						<input class="btn btn-primary border-inner py-3 px-5" type="submit" value="Entrar" id="btnEnviar"/>
					</form>
					<div id="divBienvenido" style="display:none">
						<h4>Hola <span id="paraNombre"></span></h4>
						<h5>Est&aacute;s firmado como <span id="paraTipo"></span></h5>
					</div>
					
				</section>
			</main>
			<!-- ingresar End -->

<?php
include_once("team.html");
include_once("footer.html");
?>		