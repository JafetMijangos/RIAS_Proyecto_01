<?php
include_once("modelo/Empleado.php");
include_once("modelo/Cliente.php");
include_once("utils/ErroresAplic.php");
session_start();
$nErr = -1;
if (isset($_SESSION["sTipoFirmado"])) {
	if ($_SESSION["sTipoFirmado"] == 'Cliente') {
		include_once("cabecera.html");
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
<script src="js/comprar.js"></script>
</head>
    <body>
    </body>
</html>