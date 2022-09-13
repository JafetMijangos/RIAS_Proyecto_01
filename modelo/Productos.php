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

abstract class Productos {
protected int $nClaveProducto=0;
protected string $sNombre="";
protected int $nLinea="";
protected int $nTipo="";
protected string $sDescripcion="";
protected string $sSabor="";
protected string $sImagen = "";
protected float $sPrecio = 0;

	abstract public function buscar(): bool;

	abstract public function buscarTodos():array;

	abstract public function buscarTodosFiltro():array;

	abstract public function insertar():int;

	abstract public function modificar():int;

	abstract public function eliminar():int;

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