<?php
/*************************************************************
 * Cliente.php
 * Objetivo: clase que encapsula el manejo del concepto Cliente
 * Autor: BAOZ
 *************************************************************/
error_reporting(E_ALL);
include_once("Usuario.php");

class Cliente extends Usuario {
protected string $sNombreCompleto="";
protected string $sCalle="";
protected int $sNumero=0;
protected string $sColonia="";
protected string $sCiudad="";
protected string $sEstado="";
protected string $sTelefonoCasa="";
protected string $sTelefonoCell=""; 

	public function buscarCvePwd():bool {
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$bRet = false;
	$arrParams=array();
		if (empty($this->sCorreo) || empty($this->sContrasenia))
			throw new Exception("Cliente->buscarCvePwd: faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
				$sQuery = " SELECT t1.sCorreo, t2.nombre, t2.calle, t2.numero, 
								   t2.colonia, t2.ciudad, t2.estado,
								   t2.telCelular, t2.telCasa,
							FROM Usuario t1
							JOIN Cliente t2 ON t2.sCorreo = t1.sCorreo
							WHERE t1.sCorreo = :pCorreo
							AND t1.scontrasenia = :pPwd";
				$arrParams = array(":pCorreo"=>$this->sCorreo,
								   ":pPwd"=>$this->sContrasenia);
				$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
				$oAccesoDatos->desconectar();
				if ($arrRS){
					$this->sCorreo = $arrRS[0][0];
					$this->sNombreCompleto = $arrRS[0][1];
					$this->sCalle = $arrRS[0][2];
					$this->sNumero = $arrRS[0][3];
					$this->sColonia = $arrRS[0][4];
					$this->sCiudad = $arrRS[0][5];
					$this->sEstado = $arrRS[0][6];
					$this->sTelefonoCasa = $arrRS[0][7];
					$this->sTelefonoCell = $arrRS[0][8];
					$bRet = true;
				}
			}
		}
		return $bRet;
	}

	public function buscar():bool {
		throw new Exception("Cliente->buscar: no implementada");
	}

	public function buscarTodos():array {
		throw new Exception("Cliente->buscarTodos: no implementada");
	}

	public function insertar():int {
		throw new Exception("Cliente->insertar: no implementada");
	}

	public function modificar():int {
		throw new Exception("Cliente->modificar: no implementada");
	}

	public function eliminar():int {
		throw new Exception("Cliente->eliminar: no implementada");
	}
	
	public function getNombreCompleto():string{
		return $this->sNombreCompleto;
	 }
	public function setNombreCompleto(string $valor){
		$this->sNombreCompleto = $valor;
	 }
  
	 public function getCalle():string{
		return $this->sCalleNumero;
	 }
	public function setCalle(string $valor){
		$this->sCalleNumero = $valor;
	 }

	 public function getNumero():int{
		return $this->sNumero;
	 }
	public function setNumero(int $valor){
		$this->sNumero = $valor;
	 }
  
	 public function getColonia():string{
		return $this->sColonia;
	 }
	public function setColonia(string $valor){
		$this->sColonia = $valor;
	 }
  
	 public function getCiudad():string{
		return $this->sCiudad;
	 }
	public function setCiudad(string $valor){
		$this->sCiudad = $valor;
	 }
  
	 public function getEstado():string{
		return $this->sEstado;
	 }
	public function setEstado(string $valor){
		$this->sEstado = $valor;
	 }
  
	 public function getTelefonoCasa():string{
		return $this->sTelefonoCasa;
	 }
	public function setTelefonoCasa(string $valor){
		$this->sTelefonoCasa = $valor;
	 }
  
	 public function getTelefonoCell():string{
		return $this->sTelefonoCell;
	 }
	public function setTelefonoCell(string $valor){
		$this->sTelefonoCell = $valor;
	 }  
}
?>