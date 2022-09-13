<?php
/*Archivo:  ctrlBuscaProductos.php
Objetivo: control para buscar productos, considera filtrado
Autor:    Pastelería
*/
include_once("../modelo/Pasteles.php");
include_once("../modelo/Galletas.php");
include_once("../modelo/Gelatinas.php");
include_once("../modelo/Panquesitos.php");
include_once("../utils/ErroresAplic.php");
$nErr=-1;
$nNum=0;
$oProducto=null;
$arrEncontrados=null;
$sJsonRet = "";
$oErr = null;
	/*Verifica que haya llegado el tipo y el filtro (que puede ser vacío)*/
	if (isset($_REQUEST["cmbTipo"]) && !empty($_REQUEST["cmbTipo"]) &&
		isset($_REQUEST["cmbFiltro"])){
		try{
			//Convierte el tipo indicado a número
			$nNum = intval(($_REQUEST["cmbTipo"]),10);
			
			//Busca en la base de datos de acuerdo al tipo indicado
			if ($nNum==1){
				$oProducto = new Pasteles();
				if (empty($_REQUEST["cmbFiltro"]))
					$arrEncontrados = $oProducto->buscarTodos();
				else{
					oProducto->setTipo((int)$_REQUEST["cmbFiltro"]);
					$arrEncontrados = $oProducto->buscarTodosFiltro();
				}
			}else if ($nNum==2){
				$oProducto = new Galletas();
				if (empty($_REQUEST["cmbFiltro"]))
					$arrEncontrados = $oProducto->buscarTodos();
				else{
					//sería deseable validar que sea número lo que se recibe
					$oProducto->setTipo((int)$_REQUEST["cmbFiltro"]);
					$arrEncontrados = $oProducto->buscarTodosFiltro();
				}
			}else if ($nNum==3){
				$oProducto = new Gelatinas();
				if (empty($_REQUEST["cmbFiltro"]))
					$arrEncontrados = $oProducto->buscarTodos();
				else{
					//sería deseable validar que sea número lo que se recibe
					$oProducto->setTipo((int)$_REQUEST["cmbFiltro"]);
					$arrEncontrados = $oProducto->buscarTodosFiltro();
				}
			}else if ($nNum==4){
				$oProducto = new Panquesitos();
				if (empty($_REQUEST["cmbFiltro"]))
					$arrEncontrados = $oProducto->buscarTodos();
				else{
					//sería deseable validar que sea número lo que se recibe
					$oProducto->setTipo((int)$_REQUEST["cmbFiltro"]);
					$arrEncontrados = $oProducto->buscarTodosFiltro();
				}
			}else
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