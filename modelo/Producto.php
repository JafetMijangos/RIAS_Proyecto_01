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

   private int $nClaveProducto = 0;
   private string $sNombre = "";
   private int $nLineas = 0;
   private int $nTipo = 0;
   private string $sDescripcion = "";
   private string $sSabor = "";
   private string $sImagen = "";
   private float $sPrecio = 0;

   //Constantes para los filtros por linea
   public const PASTEL = 1;
   public const GALLETA = 2;
   public const GELATINA = 3;
   public const PANQUESITO = 4;
   //Constantes para los filtros tipo
   public const NORMAL = 1;
   public const DIETETICO = 2;
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
      self::DIETETICO => "Dietético",
      self::DIABETICO => "Diabético",
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
      return $this->nLineas;
   }
   public function setLinea(int $valor)
   {
      $this->nLineas = $valor;
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
         $this->nLineas > 0 &&
         array_key_exists($this->nLineas . "", self::$arrLineas))
         $sRet = self::$arrLineas[$this->nLineas . ""];
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
         $this->nTipo > 0 &&
         array_key_exists($this->nTipo . "", self::$arrTipos)
      )
         $sRet = self::$arrTipos[$this->nTipo . ""];
      return $sRet;
   }

   //No existe set porque la información es fija
   public function getTip(): array
   {
      return self::$arrTipos;
   }

   // ------------------ Funciones de consulta ------------------------

   public function buscar(): bool // Busqueda especifica
   {
      throw new Exception("Productos->buscar: no implementada"); 
   }

   public function buscarTodos(): array
   {
      $oAccesoDatos = new AccesoDatos();
      $sQuery = "";
      $arrRS = null;
      $arrLinea = null;
      $oProducto = null;
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

   public function buscarTodosFiltroLinea(): array
   {
      $oAccesoDatos = new AccesoDatos();
      $sQuery = "";
      $arrRS = null;
      $arrLinea = null;
      $oProducto = null;
      $arrRet = array();

      //En este ejemplo, el filtro es por linea
      if ($this->nLineas <= 0)
         throw new Exception("Productos->buscarTodosFiltro: faltan datos de Linea");//cambiar
      else {
         if ($oAccesoDatos->conectar()) {
            $sQuery = "SELECT t1.nClaveProducto, t1.sNombre, t1.nLinea, t1.nTipo, t1.sDescripcion,
            t1.sSabor, t1.sImagen, t1.sPrecio 
             FROM productos t1
             WHERE t1.nLinea = :lin
             ORDER BY t1.sNombre;
         ";
   
            $arrParams = array(":lin" => $this->nLineas);
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
      if ($this->nTipo <= 0)
         throw new Exception("Productos->buscarTodosFiltro: faltan datos de tipo");//cambiar
      else {
         if ($oAccesoDatos->conectar()) {
            $sQuery = "SELECT t1.nClaveProducto, t1.sNombre, t1.nLinea, t1.nTipo, t1.sDescripcion,
            t1.sSabor, t1.sImagen, t1.sPrecio 
             FROM productos t1
             WHERE t1.nTipo = :tip
             ORDER BY t1.sNombre;
         ";
   
            $arrParams = array(":tip" => $this->nTipo);
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
      if ($this->nLineas <= 0 &&  $this->nTipo <= 0)
         throw new Exception("Productos->buscarTodosFiltro: faltan datos de ambos filtros");//cambiar
      else {
         if ($oAccesoDatos->conectar()) {
            $sQuery = "SELECT t1.nClaveProducto, t1.sNombre, t1.nLinea, t1.nTipo, t1.sDescripcion,
            t1.sSabor, t1.sImagen, t1.sPrecio 
             FROM productos t1
             WHERE t1.nLinea = :lin
             AND t1.nTipo = :tip
             ORDER BY t1.sNombre;
         ";
   
            $arrParams = array(":lin" => $this->nLineas, ":tip" => $this->nTipo);
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

   // Otras acciones por agregar

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
