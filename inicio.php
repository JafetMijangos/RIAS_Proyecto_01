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
		include_once("cabecera.html");
	}else{
		header("Location: error.php?nError=".ErroresAplic::NO_FIRMADO);
		exit();
	}
?>
	<script src="js/ctrlBienvenido.js"></script>
    </head>
    <body>
    </body>
</html>