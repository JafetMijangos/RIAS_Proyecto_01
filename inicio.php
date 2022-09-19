<?php
/*
Archivo:  inicio.php
Objetivo: página inicial cuando ya está firmado 
Autor:    BAOZ
*/
include_once("modelo/Empleado.php");
include_once("modelo/Cliente.php");
session_start();
	if (isset($_SESSION["sTipoFirmado"])){
		include_once("header.html");
		include_once("menu.php");
	}else{
		header("Location: error.php?nError=".ErroresAplic::NO_FIRMADO);
		exit();
	}
?>
			<main id="main-content">
				<section>
					<header>
					<div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
						    <h2 class="text-primary font-secondary">Bienvenido <?php echo $_SESSION["sNomFirmado"]; ?></h2>
						</div>
					</header>
					<div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
					    <h1 class="display-4 text-uppercase">Est&aacute;s firmado como 
					<?php echo $_SESSION["sDescFirmado"]; ?></h1>
					</div>
				</section>
			</main>
<?php
include_once("footer.html");
?>