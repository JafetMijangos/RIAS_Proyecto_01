<?php
include_once("modelo/Empleado.php");
include_once("utils/ErroresAplic.php");
session_start();
$nErr = -1;
	if (isset($_SESSION["sTipoFirmado"])){
		if ($_SESSION["sTipoFirmado"]==Empleado::ADMINISTRADOR){
			include_once("header.html");
			include_once("menu.php");
		}else{
			$nErr = ErroresAplic::SIN_PERMISOS;
		}
	}else{
		$nErr = ErroresAplic::NO_FIRMADO;
	}
	if ($nErr > -1){
		header("Location: error.php?nError=".$nErr);
		exit();
	}
?>
			<main id="main-content">
				<section>
				<header>
					<div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
					    <h2 class="text-primary font-secondary">Gestionar Productos</h2>
					</div>
				</header>
				    <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
					    <h1 class="display-4 text-uppercase">EN CONSTRUCCI&Oacute;N, disculpe las molestias</h1>
				    </div>
				</section>
			</main>
<?php
include_once("footer.html");
?>