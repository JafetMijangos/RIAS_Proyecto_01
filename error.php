<?php
/*
Archivo:  error.php
Objetivo: manejo de errores
Autor:    BAOZ
*/
include_once("utils/ErroresAplic.php");
$nErr=-1;
$oErr = new ErroresAplic();
	if (isset($_REQUEST["nError"]) && !empty($_REQUEST["nError"]))
		$nErr = (int)$_REQUEST["nError"];
	$oErr->setError($nErr);
?>
<!DOCTYPE html>
<?php include_once("php_components/headerror.php"); ?>
	<body>
	   <?php include_once("php_components/header.php"); ?>

	   <section id="banner">
            <img src="img/bannererror.jpg">
        </section>
	    <section id="Bienvenidos">
		<div class="contenedor">
		<h3>Error</h3>
		<?php echo htmlentities($oErr->getTextoError(), 
		ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");?>
		<br>
        </section>
        </div>

		<?php include_once("php_components/footer.php"); ?>
	</body>
</html>