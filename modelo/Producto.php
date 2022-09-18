<?php

/*************************************************************
 * Producto.php
 * Objetivo: clase que encapsula el manejo del concepto Producto
 * Autor: Pasteleria
 *************************************************************/
error_reporting(E_ALL);
include_once("AccesoDatos.php");

class Producto
{

   protected int $nClaveProducto = 0;
   protected string $sNombre = "";
   protected int $nLinea = 0;
   protected int $ntipo = 0;
   protected string $sDescripcion = "";
   protected string $sSabor = "";
   protected string $sImagen = "";
   protected float $sPrecio = 0;

   private int $nLin = 0;
   private int $nTip = 0;

   //Constantes para los filtros por linea
   public const PASTEL = 1;
   public const GALLETA = 2;
   public const GELATINA = 3;
   public const PANQUESITO = 4;
   //Constantes para los filtros tipo
   public const NORMAL = 1;
   public const DIETETICO = 1;
   public const DIABETICO = 3;
   public const VEGANO = 4;
   //No existe en el modelo, pero facilita el manejo de las restricciones
   private static $arrLineas = array(
      self::PASTEL => "Pastel",
      self::GALLETA => "Galleta",
      self::GELATINA => "Gelatina",
      self::PANQUESITO => "Panquesito"
   );

   private static $arrTipos = array(
      self::NORMAL => "Normal",
      self::DIETETICO => "Dietetico",
      self::DIABETICO => "Diabetico",
      self::VEGANO => "Vegano"
   );

   //Getter y setter
   public function getClaveProducto(): int
   {
      return $this->nClaveProducto;
   }
   public function setClaveProducto(int $valor)
   {
      $this->nClaveProducto = $valor;
   }
   public function getNombre(): string
   {
      return $this->sNombre;
   }
   public function setNombre(string $valor)
   {
      $this->sNombre = $valor;
   }

   public function getLinea(): int
   {
      return $this->nLinea;
   }
   public function setLinea(int $valor)
   {
      $this->nLinea = $valor;
   }

   public function getTipo(): int
   {
      return $this->nTipo;
   }
   public function setTipo(int $valor)
   {
      $this->nTipo = $valor;
   }

   public function getDescripcion(): string
   {
      return $this->sDescripcion;
   }
   public function setDescripcion(string $valor)
   {
      $this->sDescripcion = $valor;
   }

   public function getSabor(): string
   {
      return $this->sSabor;
   }
   public function setSabor(string $valor)
   {
      $this->sSabor = $valor;
   }
   public function getImg(): string
   {
      return $this->sImagen;
   }
   public function setImg(string $valor)
   {
      $this->sImagen = $valor;
   }

   public function getPrecio(): float
   {
      return $this->sPrecio;
   }
   public function setPrecio(float $valor)
   {
      $this->sPrecio = $valor;
   }
   //Para obtener las descripciones de la linea
   public function getDescripcionLinea(): string
   {
      $sRet = "";
      if (
         $this->nLin > 0 &&
         array_key_exists($this->nLin . "", self::$arrLineas)
      )
         $sRet = self::$arrLineas[$this->nLin . ""];
      return $sRet;
   }

   //No existe set porque la información es fija
   public function getLi(): array
   {
      return self::$arrLineas;
   }


   public function getDescripcionTipo(): string
   {
      $sRet = "";
      if (
         $this->nTip > 0 &&
         array_key_exists($this->nTip . "", self::$arrTipos)
      )
         $sRet = self::$arrTipos[$this->nTip . ""];
      return $sRet;
   }

   //No existe set porque la información es fija
   public function getTip(): array
   {
      return self::$arrTipos;
   }

   //Funciones específicas NO OLVIDES CAMBIAR LOS NOMBRE!!!!!!


   public function buscarTodos(): array
   {
      $oAccesoDatos = new AccesoDatos();
      $sQuery = "";
      $arrRS = null;
      $arrLinea = null;
      $oProducto = null; //Cambiar nombre
      $arrRet = array();
      if ($oAccesoDatos->conectar()) {
         $sQuery = "SELECT t1.nClaveProducto, t1.sNombre, t1.nLinea, t1.nTipo, t1.sDescripcion,
                           t1.sSabor, t1.sImagen, t1.sPrecio 
                            FROM productos t1
                            ORDER BY t1.sNombre;
                  ";
         $arrParams = array();
         $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
         $oAccesoDatos->desconectar();
         if ($arrRS) {
            $arrRet = array();
            foreach ($arrRS as $arrLinea) {
               $oProducto = new Producto();
               $oProducto->setClaveProducto($arrLinea[0]);
               $oProducto->setNombre($arrLinea[1]);
               $oProducto->setLinea($arrLinea[2]);
               $oProducto->setTipo($arrLinea[3]);
               $oProducto->setDescripcion($arrLinea[4]);
               $oProducto->setSabor($arrLinea[5]);
               $oProducto->setImg($arrLinea[6]);
               $oProducto->setPrecio($arrLinea[7]);
               $arrRet[] = $oProducto; //más rápido que array_push($arrRet, $oPlantaOrnato)
            }
         }
      }
      return $arrRet;
   }

   public function buscar(): bool
   {
      throw new Exception("Productos->buscar: no implementada"); //Cambiar nombre luego
   }

   public function buscarTodosFiltroLinea(): array
   {
      $oAccesoDatos = new AccesoDatos();
      $sQuery = "";
      $arrRS = null;
      $arrLinea = null;
      $oProducto = null;
      $arrRet = array();
      //En este ejemplo, el filtro es por presentación
      if ($this->nLin <= 0)
         throw new Exception("Productos->buscarTodosFiltro: faltan datos");//cambiar
      else {
         if ($oAccesoDatos->conectar()) {
            $sQuery = "SELECT t1.nClaveProducto, t1.sNombre, t1.nLinea, t1.nTipo, t1.sDescripcion,
            t1.sSabor, t1.sImagen, t1.sPrecio 
             FROM productos t1
             WHERE t1.nLinea = :lin
             ORDER BY t1.sNombre;
         ";
   
            $arrParams = array(":lin" => $this->nLin);
            $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
            $oAccesoDatos->desconectar();
            if ($arrRS) {
               $arrRet = array();
               foreach ($arrRS as $arrLinea) {
                  $oProducto = new Producto();
                  $oProducto->setClaveProducto($arrLinea[0]);
                  $oProducto->setNombre($arrLinea[1]);
                  $oProducto->setLinea($arrLinea[2]);
                  $oProducto->setTipo($arrLinea[3]);
                  $oProducto->setDescripcion($arrLinea[4]);
                  $oProducto->setSabor($arrLinea[5]);
                  $oProducto->setImg($arrLinea[6]);
                  $oProducto->setPrecio($arrLinea[7]);
                  $arrRet[] = $oProducto; //más rápido que array_push($arrRet, $oPlantaOrnato)
               }
            }
         }
      }
      return $arrRet;
   }

   public function buscarTodosFiltroTipo(): array
   {
      $oAccesoDatos = new AccesoDatos();
      $sQuery = "";
      $arrRS = null;
      $arrLinea = null;
      $oProducto = null;
      $arrRet = array();
      //En este ejemplo, el filtro es por presentación
      if ($this->nTip <= 0)
         throw new Exception("Productos->buscarTodosFiltro: faltan datos");//cambiar
      else {
         if ($oAccesoDatos->conectar()) {
            $sQuery = "SELECT t1.nClaveProducto, t1.sNombre, t1.nLinea, t1.nTipo, t1.sDescripcion,
            t1.sSabor, t1.sImagen, t1.sPrecio 
             FROM productos t1
             WHERE t1.nTipo = :tip
             ORDER BY t1.sNombre;
         ";
   
            $arrParams = array(":tip" => $this->nTip);
            $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
            $oAccesoDatos->desconectar();
            if ($arrRS) {
               $arrRet = array();
               foreach ($arrRS as $arrLinea) {
                  $oProducto = new Producto();
                  $oProducto->setClaveProducto($arrLinea[0]);
                  $oProducto->setNombre($arrLinea[1]);
                  $oProducto->setLinea($arrLinea[2]);
                  $oProducto->setTipo($arrLinea[3]);
                  $oProducto->setDescripcion($arrLinea[4]);
                  $oProducto->setSabor($arrLinea[5]);
                  $oProducto->setImg($arrLinea[6]);
                  $oProducto->setPrecio($arrLinea[7]);
                  $arrRet[] = $oProducto; //más rápido que array_push($arrRet, $oPlantaOrnato)
               }
            }
         }
      }
      return $arrRet;
   }

   public function buscarTodosFiltroDoble(): array
   {
      $oAccesoDatos = new AccesoDatos();
      $sQuery = "";
      $arrRS = null;
      $arrLinea = null;
      $oProducto = null;
      $arrRet = array();
      //En este ejemplo, el filtro es por presentación
      if ($this->nLin <= 0 &&  $this->nTip <= 0)
         throw new Exception("Productos->buscarTodosFiltro: faltan datos");//cambiar
      else {
         if ($oAccesoDatos->conectar()) {
            $sQuery = "SELECT t1.nClaveProducto, t1.sNombre, t1.nLinea, t1.nTipo, t1.sDescripcion,
            t1.sSabor, t1.sImagen, t1.sPrecio 
             FROM productos t1
             WHERE t1.nLinea = :lin
             AND t1.nTipo = :tip
             ORDER BY t1.sNombre;
         ";
   
            $arrParams = array(":lin" => $this->nLin, ":tip" => $this->nTip);
            $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
            $oAccesoDatos->desconectar();
            if ($arrRS) {
               $arrRet = array();
               foreach ($arrRS as $arrLinea) {
                  $oProducto = new Producto();
                  $oProducto->setClaveProducto($arrLinea[0]);
                  $oProducto->setNombre($arrLinea[1]);
                  $oProducto->setLinea($arrLinea[2]);
                  $oProducto->setTipo($arrLinea[3]);
                  $oProducto->setDescripcion($arrLinea[4]);
                  $oProducto->setSabor($arrLinea[5]);
                  $oProducto->setImg($arrLinea[6]);
                  $oProducto->setPrecio($arrLinea[7]);
                  $arrRet[] = $oProducto; //más rápido que array_push($arrRet, $oPlantaOrnato)
               }
            }
         }
      }
      return $arrRet;
   }


   public function insertar(): int
   {
      throw new Exception("Producto->insertar: no implementada");
   }

   public function modificar(): int
   {
      throw new Exception("Producto->modificar: no implementada");
   }

   public function eliminar(): int
   {
      throw new Exception("Producto->eliminar: no implementada");
   }
}
