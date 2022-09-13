<?php
/*************************************************************
 * Galletas.php
 * Objetivo: clase que encapsula el manejo del concepto Galletas
 *			
 * Autor: Pasteleria
 *************************************************************/
error_reporting(E_ALL);
include_once("Productos.php");

class Galletas extends Productos {
private int $sTipo = 0;

//Constantes para facilitar la lectura de Presentación
public CONST NORMAL = 1;
public CONST DIETETICO = 2;
public CONST DIABETICO = 3;
public CONST VEGANO = 4;
    
//sNombre, sLinea, sTipo, sDescripcion, sSabor, sImagen, sPrecio
//Pasteles =1, Galletas=2,Gelatinas=3,Panquecitos=4

	public function buscarTodos():array{
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$arrLinea = null;
	$oProducto=null;
	$arrRet=array();
		if ($oAccesoDatos->conectar()){
			$sQuery = "SELECT t1.nClaveProducto, t1.sNombre, t1.nLinea, t1.nTipo, 
							  t1.sDescripcion, t1.sSabor,t1.sImagen,t1.sPrecio
						FROM Productos t1
						WHERE t1.nLinea = 2
						ORDER BY t1.sNombre;
					";
			$arrParams = array();
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				$arrRet = array();
				foreach($arrRS as $arrLinea){
					$oProducto = new Galletas();
					$oProducto->setClaveProducto($arrLinea[0]);
					$oProducto->setNombre($arrLinea[1]);
					$oProducto->setTipo($arrLinea[2]);
					$oProducto->setDescripcion($arrLinea[3]);
					$oProducto->setSabor($arrLinea[4]);
					$oProducto->setImg($arrLinea[5]);
					$oProducto->setPrecio($arrLinea[6]);
					$arrRet[] = $oProducto; //más rápido que array_push($arrRet, $oProducto)
				}
			}
		} 
		return $arrRet;
	}

	public function buscar():bool {
		throw new Exception("Galletas->buscar: no implementada");
	}

	public function buscarTodosFiltro():array {
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$arrLinea = null;
	$oProducto=null;
	$arrRet=array();
		//Filtro por Tipo
		if (empty($this->nTipo))
			throw new Exception("Galletas->buscarTodosFiltro: faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
				$sQuery = "SELECT t1.nClaveProducto, t1.sNombre, t1.nLinea, t1.nTipo, 
								  t1.sDescripcion, t1.sSabor,t1.sImagen,t1.sPrecio
							FROM Productos t1
							WHERE t1.nLinea = 2
							AND t1.nTipo = :tipo
							ORDER BY t1.sNombre;
						";
				$arrParams = array(":tipo"=>$this->sTipo);
				$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
				$oAccesoDatos->desconectar();
				if ($arrRS){
					$arrRet = array();
					foreach($arrRS as $arrLinea){
						$oProducto = new Galletas();
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
		throw new Exception("Galletas->insertar: no implementada");
	}

	public function modificar():int {
		throw new Exception("Galletas->modificar: no implementada");
	}

	public function eliminar():int {
		throw new Exception("Galletas->eliminar: no implementada");
	}
	
    public function getTipo():int{
       return $this->sTipo;
    }
	public function setTipo(int $valor){
       $this->sTipo = $valor;
    }
}
