<?php
/*************************************************************
 * Productos.php
 * Objetivo: clase que encapsula el manejo del concepto Productos "Pasteles"
 *			(clase abstracta creada para manejar los elementos
 *           comunes que existen entre los productos PASTELERIA )
 * Autor: PASTELERIA
 *************************************************************/
error_reporting(E_ALL);
include_once("AccesoDatos.php");

class Productos {
   protected int $nClaveProducto=0;
   protected string $sNombre="";
   protected int $nLinea="";
   protected int $nTipo="";
   protected string $sDescripcion="";
   protected string $sSabor="";
   protected string $sImagen = "";
   protected float $sPrecio = 0;

   public function buscar() {}

	public function buscarTodos(){
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
						ORDER BY t1.sNombre;
					";
			$arrParams = array();
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				$arrRet = array();
				foreach($arrRS as $arrLinea){
					$oProducto = new Productos();
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

   public function buscarTodosFiltro(){
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
						WHERE t1.nLinea = :linea
						ORDER BY t1.sNombre;
					";
			$arrParams = array(":linea"=>$this->nLinea);
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				$arrRet = array();
				foreach($arrRS as $arrLinea){
					$oProducto = new Productos();
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
   //Función por si quieres hacerlo de doble filtro
   public function buscarTodosDobleFiltro(){
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
						WHERE t1.nLinea = :linea
                  		and t1.nTipo = :tipo
						ORDER BY t1.sNombre;
					";
			$arrParams = array(":linea"=>$this->nLinea, ":tipo"=>$this->nTipo);
			$arrParams = array();
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				$arrRet = array();
				foreach($arrRS as $arrLinea){
					$oProducto = new Productos();
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

	 public function insertar(){}

	 public function modificar(){}

	 public function eliminar(){}

    public function getClaveProducto():int{
      return $this->nClave;
   }
    public function setClaveProducto(int $valor){
      $this->nClave = $valor;
   }
    public function getNombre():string{
       return $this->sNombre;
    }
	public function setNombre(string $valor){
       $this->sNombre = $valor;
    }
	
    public function getLinea():int{
       return $this->nLinea;
    }
	public function setLinea(int $valor){
       $this->nLinea = $valor;
    }
    
    public function getTipo():int{
       return $this->nTipo;
    }
	public function setTipo(int $valor){
       $this->nTipo = $valor;
    }
    
    public function getDescripcion():string{
       return $this->sDescripcion;
    }
	public function setDescripcion(string $valor){
       $this->sDescripcion = $valor;
    }
    
    public function getSabor():string{
      return $this->sDescripcion;
   }
  public function setSabor(string $valor){
      $this->sDescripcion = $valor;
   }
    public function getImg():string{
       return $this->sImagen;
    }
	public function setImg(string $valor){
       $this->sImagen = $valor;
    }
    
    public function getPrecio():float{
       return $this->sPrecio;
    }
	public function setPrecio(float $valor){
       $this->sPrecio = $valor;
    }
    
}
?>