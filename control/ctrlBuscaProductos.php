<?php
/*Archivo:  ctrlBuscaProductos.php
Objetivo: control para buscar productos, considera filtrado
Autor:    Pastelería
*/
include_once("../modelo/Productos.php");
include_once("../utils/ErroresAplic.php");
$nErr=-1;
$nNum=0;
$oProducto=null;
$arrEncontrados=null;
$sJsonRet = "";
$oErr = null;
	/*Verifica que haya llegado el tipo y el filtro (que puede ser vacío)*/
	if (isset($_REQUEST["nLinea"]) && !empty($_REQUEST["nLinea"]) &&
		isset($_REQUEST["nTipo"])){
		try{
			//Convierte el tipo indicado a número
			$nNum = intval(($_REQUEST["nLinea"]),10);
			$nNum2 = intval(($_REQUEST["nTipo"]),10);
			//Busca en la base de datos de acuerdo al tipo indicado
			$oProducto = new Productos();
			if ($nNum==0){
				$arrEncontrados = $oProducto->buscarTodos();
			}else if ($nNum==1){//Pasteles
				$arrEncontrados = $oProducto->buscarTodosFiltro($_REQUEST["nLinea"]);//Así se debe llamar el select
			}else if ($nNum==2){//Galletas
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($_REQUEST["nLinea"]);
			}else if ($nNum==3){//Gelatinas
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($_REQUEST["nLinea"]);
			}else if ($nNum==4){//Panquesitos
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($_REQUEST["nLinea"]);
			}else if ($nNum==1 && $nNum2==1){//Para pastel normal
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);
			}else if ($nNum==1 && $nNum2==2){//Para pastel dietetico
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);
			}else if ($nNum==1 && $nNum2==3){//Para pastel para diabeticos
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);
			}else if ($nNum==1 && $nNum2==4){//Para pastel para veganos
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);
			}else if ($nNum==2 && $nNum2==1){//Para Galletas normal
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);
			}else if ($nNum==2 && $nNum2==2){//Para Galletas dietetico
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);
			}else if ($nNum==2 && $nNum2==3){//Para Galletas diabetico
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);	
			}else if ($nNum==2 && $nNum2==4){//Para Galletas veganos
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNelse
			}else if ($nNum==3 && $nNum2==1){//Para Gelatinas normal
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);
			}else if ($nNum==3 && $nNum2==2){//Para Gelatinas dietetico
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);
			}else if ($nNum==3 && $nNum2==3){//Para Gelatinas diabetico
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);	
			}else if ($nNum==3 && $nNum2==4){//Para Gelatinas veganos
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);
			}else if ($nNum==4 && $nNum2==1){//Para Panquecitos normal
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);
			}else if ($nNum==4 && $nNum2==2){//Para Panquecitos dietetico
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);
			}else if ($nNum==4 && $nNum2==3){//Para Panquecitos diabetico
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);	
			}else if ($nNum==4 && $nNum2==4){//Para Panquecitos veganos
				$arrEncontrados = $oProducto->buscarTodosDobleFiltro($nNum,$nNum2);
			}else{
				$nErr = ErroresAplic::TIPO_PROD_INEXISTENTE;
			}catch(Exception $e){
			//Enviar el error específico a la bitácora de php (dentro de php\logs\php_error_log
			error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
			$nErr = ErroresAplic::ERROR_EN_BD;
		}
	}
	else
		$nErr = ErroresAplic::FALTAN_DATOS;
	
	if ($nErr==-1){
		$sJsonRet = 
		'{
			"success":true,
			"status": "ok",
			"data":{
				"arrProds": [
		';
		//Recorrer arreglo para llenar objetos
		/*"otros":"'.(($oProducto instanceOf Planta)?$oProducto->getTipo():$oProducto->getDescripPresentacion()).'",
			Por si sí es útil*/
		foreach($arrEncontrados as $oProducto){
			$sJsonRet = $sJsonRet.'{
					"clave": '.$oProducto->getClaveProducto().', 
					"nombre":"'.$oProducto->getNombre().'", 
					"tipo":"'.$oProducto->getTipo().'",
					"descripcion":"'.$oProducto->getDescripcion().'",
					"sabor":"'.$oProducto->getSabor().'";
					"imagen":"'.$oProducto->getImg().'", 
					"precio":"'.$oProducto->getPrecio().'"
					},';
		}
		//Sobra una coma, eliminarla
		$sJsonRet = substr($sJsonRet,0, strlen($sJsonRet)-1);
		
		//Colocar cierre de arreglo y de objeto
		$sJsonRet = $sJsonRet.'
				]
			}
		}';
	}else{
		$oErr = new ErroresAplic();
		$oErr->setError($nErr);
		$sJsonRet = 
		'{
			"success":false,
			"status": "'.$oErr->getTextoError().'",
			"data":{}
		}';
	}
	//Retornar JSON a quien hizo la llamada
	header('Content-type: application/json');
	echo $sJsonRet;
?>