<?php
/*************************************************************
 * Panquesitos.php
 * Objetivo: clase que encapsula el manejo del concepto Panquesito
 *			
 * Autor: Pasteleria
 *************************************************************/
error_reporting(E_ALL);
include_once("Productos.php");

class Panquesitos extends Productos {
private int $sTipo = 0;

//Constantes para facilitar la lectura de Presentación
public CONST NORMAL = 1;
public CONST DIETETICO = 2;
public CONST DIABETICO = 3;
public CONST VEGANO = 4;
    
//sNombre, sLinea, sTipo, sDescripcion, sSabor, sImagen, sPrecio
	public function buscarTodos():array{
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$arrLinea = null;
	$oProducto=null;
	$arrRet=array();
		if ($oAccesoDatos->conectar()){
			$sQuery = "SELECT t1.nClaveProducto, t1.sNombre, t1.nLinea, t1.nTipo, 
							  t1.sDescripcion, t1.sSabor, t1.sImagen, t1.sPrecio
						FROM Productos t1
						WHERE t1.nLinea = 4
						ORDER BY t1.sNombre;
					";
			$arrParams = array();
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				$arrRet = array();
				foreach($arrRS as $arrLinea){
					$oProducto = new Panquesitos();
					$oProducto->setClaveProducto($arrLinea[0]);
					$oProducto->setNombre($arrLinea[1]);
					$oProducto->setTipo($arrLinea[2]);
					$oProducto->setDescripcion($arrLinea[3]);
					$oProducto->setSabor($arrLinea[4]);
					$oProducto->setImg($arrLinea[5]);
					$oProducto->setPrecio($arrLinea[6]);
					$arrRet[] = $oProducto; //más rápido que array_push($arrRet, $oPlantaOrnato)
				}
			}
		} 
		return $arrRet;
	}

	public function buscar():bool {
		throw new Exception("Panquesitos->buscar: no implementada");
	}

	public function buscarTodosFiltro():array {
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$arrLinea = null;
	$oProducto=null;
	$arrRet=array();
		//En este ejemplo, el filtro es por tamaño
		if (empty($this->sTamanio))
			throw new Exception("Panquesitos->buscarTodosFiltro: faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
				$sQuery = "SELECT t1.nClaveProducto, t1.sNombre, t1.nLinea, t1.nTipo, 
							  t1.sDescripcion, t1.sSabor, sImagen, sPrecio
						FROM Productos t1
						WHERE t1.nLinea = 4 
						AND t1.nTipo = :tipo
						ORDER BY t1.sNombre;
					";
				$arrParams = array(":tipo"=>$this->sTipo);
				$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
				$oAccesoDatos->desconectar();
				if ($arrRS){
					$arrRet = array();
					foreach($arrRS as $arrLinea){
						$oProducto = new Panquesitos();
						$oProducto->setClaveProducto($arrLinea[0]);
					$oProducto->setNombre($arrLinea[1]);
					$oProducto->setTipo($arrLinea[2]);
					$oProducto->setDescripcion($arrLinea[3]);
					$oProducto->setSabor($arrLinea[4]);
					$oProducto->setImg($arrLinea[5]);
					$oProducto->setPrecio($arrLinea[6]);
						$arrRet[] = $oProducto; 
					}
				}
			}
		}
		return $arrRet;
	}

	public function insertar():int {
		throw new Exception("Panquesitos->insertar: no implementada");
	}

	public function modificar():int {
		throw new Exception("Panquesitos->modificar: no implementada");
	}

	public function eliminar():int {
		throw new Exception("Panquesitos->eliminar: no implementada");
	}
	
    public function getTipo():int{
       return $this->sTipo;
    }
	public function setTipo(int $valor){
       $this->sTipo = $valor;
    }
}
?>