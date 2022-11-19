<?php
/*Archivo:  ctrlBuscaProducto.php
Objetivo: control para buscar plantas, considera filtrado
Autor:    Pasteleria
*/
include_once("../modelo/Producto.php");
include_once("../utils/ErroresAplic.php");
$nErr=-1;
$nNum=0;
$oProducto=null;
$arrEncontrados=null;
$sJsonRet = "";
$oErr = null;
	/*Verifica que haya llegado el tipo y el filtro (que puede ser vacío)*/
	if (isset($_REQUEST["cmbLinea"]) && isset($_REQUEST["cmbTipo"])){
		try{
			//Convierte el tipo indicado a número
			$nFiltroLinea = intval(($_REQUEST["cmbLinea"]),10);
			$nFiltroTipo = intval(($_REQUEST["cmbTipo"]),10);
			
			//Busca en la base de datos de acuerdo al tipo y al 
			if ($nFiltroLinea==0 && $nFiltroTipo==0){
				$oProducto = new Producto();
				$arrEncontrados = $oProducto->buscarTodos();
				
			}else if ($nFiltroLinea>0 && $nFiltroLinea<5){ // de 1 a 4 en linea
				$oProducto = new Producto();
				if ($nFiltroTipo>0 && $nFiltroTipo<5){
					$oProducto->setLinea((int)$_REQUEST["cmbLinea"]);
					$oProducto->setTipo((int)$_REQUEST["cmbTipo"]);
					$arrEncontrados = $oProducto->buscarTodosFiltroDoble();
				}else{
					// buscar todos de linea y sin filtro
					$oProducto->setLinea((int)$_REQUEST["cmbLinea"]);
					$arrEncontrados = $oProducto->buscarTodosFiltroLinea();
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
		foreach($arrEncontrados as $oProducto){// NOTA: SE MODIFICO EL NOMBRE DE LOS JSON POR TXT COMO EL GESTIONAR
			$sJsonRet = $sJsonRet.'{
					"clave": '.$oProducto->getClaveProducto().', 
					"nombre":"'.$oProducto->getNombre().'", 
					"cmbLineaD":"'.$oProducto->getDescripcionLinea().'",
					"cmbTipoD":"'.$oProducto->getDescripcionTipo().'",
					"txtDescripcion":"'.$oProducto->getDescripcion().'", 
					"txtSabor":"'.$oProducto->getSabor().'", 
					"txtImg":"'.$oProducto->getImg().'", 
					"precio":'.$oProducto->getPrecio().',
					"activo": ' . ($oProducto->getActivo() ? "true" : "false") . '
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