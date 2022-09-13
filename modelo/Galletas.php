<?php
/*************************************************************
 * Galletas.php
 * Objetivo: clase que encapsula el manejo del concepto Galletas
 *			
 * Autor: Pasteles
 *************************************************************/
error_reporting(E_ALL);
include_once("Productos.php");

class Galletas extends Productos {
private string $sTipo = "";

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
					$oProducto->setLinea($arrLinea[2]);
					$oProducto->setTipo($arrLinea[3]);
					$oProducto->setDescripcion($arrLinea[4]);
				
					$arrRet[] = $oProducto; //más rápido que array_push($arrRet, $oProducto)
				}
			}
		} 
		return $arrRet;
	}

	public function buscar():bool {
		throw new Exception("Planta->buscar: no implementada");
	}

	public function buscarTodosFiltro():array {
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$arrLinea = null;
	$oPlantaOrnato=null;
	$arrRet=array();
		//En este ejemplo, el filtro es por tamaño
		if (empty($this->sTamanio))
			throw new Exception("Planta->buscarTodosFiltro: faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
				$sQuery = "SELECT t1.nClavePlanta, t1.sNombreComun, t1.nPrecio, t1.sImagen, 
								  t1.bEsDeSombra, t1.sTamanio
							FROM plantaOrnato t1
							WHERE t1.nTipo = 1
							AND t1.sTamanio = :tam
							ORDER BY t1.sNombreComun;
						";
				$arrParams = array(":tam"=>$this->sTamanio);
				$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
				$oAccesoDatos->desconectar();
				if ($arrRS){
					$arrRet = array();
					foreach($arrRS as $arrLinea){
						$oPlantaOrnato = new Planta();
						$oPlantaOrnato->setClave($arrLinea[0]);
						$oPlantaOrnato->setNombreComun($arrLinea[1]);
						$oPlantaOrnato->setPrecio($arrLinea[2]);
						$oPlantaOrnato->setImagen($arrLinea[3]);
						$oPlantaOrnato->setEsDeSombra($arrLinea[4]);
						$oPlantaOrnato->setTamanio($arrLinea[5]);
						$arrRet[] = $oPlantaOrnato; 
					}
				}
			}
		}
		return $arrRet;
	}

	public function insertar():int {
		throw new Exception("Planta->insertar: no implementada");
	}

	public function modificar():int {
		throw new Exception("Planta->modificar: no implementada");
	}

	public function eliminar():int {
		throw new Exception("Planta->eliminar: no implementada");
	}
	
    public function getTamanio():string{
       return $this->sTamanio;
    }
	public function setTamanio(string $valor){
       $this->sTamanio = $valor;
    }
}
?>