<?php
include_once("modelo/Cliente.php");
include_once("modelo/Empleado.php");
include_once("utils/ErroresAplic.php");
session_start();
$nErr = -1;
if (isset($_SESSION["sTipoFirmado"])) {
	if ($_SESSION["sTipoFirmado"] == "e") {
		include_once("header.html");
		include_once("menu.php");
	} else {
		$nErr = ErroresAplic::SIN_PERMISOS;
	}
} else {
	$nErr = ErroresAplic::NO_FIRMADO;
}
if ($nErr > -1) {
	header("Location: error.php?nError=" . $nErr);
	exit();
}
?>
<?php
include_once("cabecera.html");
?>
<script src="js/default.js"></script>