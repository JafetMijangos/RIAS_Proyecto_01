<?php
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
						<h3>Bienvenido <?php echo $_SESSION["sNomFirmado"]; ?></h3>
					</header>
					<h5>Est&aacute;s firmado como 
					<?php echo $_SESSION["sDescFirmado"]; ?>
					</h5>
				</section>
			</main>    

<?php
include_once("footer.html");
?>	