<?php
/*Archivo:  ctrlBuscaPlantas.php
Objetivo: control para buscar plantas, considera filtrado
Autor:    BAOZ
*/
include_once("../modelo/Semilla.php");
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
				$oProducto = new Semilla();
				if (empty($_REQUEST["cmbFiltro"]))
					$arrEncontrados = $oProducto->buscarTodos();
				else{
					$oProducto->setLinea($_REQUEST["cmbFiltro"]);
					$arrEncontrados = $oProducto->buscarTodosFiltro();
				}
			}else if ($nNum==2){
				$oProducto = new Semilla();
				if (empty($_REQUEST["cmbFiltro"]))
					$arrEncontrados = $oProducto->buscarTodos();
				else{
					//sería deseable validar que sea número lo que se recibe
					$oProducto->setPresentacion((int)$_REQUEST["cmbFiltro"]);
					$arrEncontrados = $oPlantaOrnato->buscarTodosFiltro();
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
		foreach($arrEncontrados as $oPlantaOrnato){
			$sJsonRet = $sJsonRet.'{
					"clave": '.$oPlantaOrnato->getClave().', 
					"nombre":"'.$oPlantaOrnato->getNombreComun().'", 
					"imagen":"'.$oPlantaOrnato->getImagen().'", 
					"esDeSombra":'.($oPlantaOrnato->getEsDeSombra()?"true":"false").',
					"otros":"'.(($oPlantaOrnato instanceOf Planta)?$oPlantaOrnato->getTamanio():$oPlantaOrnato->getDescripPresentacion()).'",
					"precio":'.$oPlantaOrnato->getPrecio().'
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