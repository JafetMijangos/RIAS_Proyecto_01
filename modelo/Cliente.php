<?php
/*************************************************************
 * Cliente.php
 * Objetivo: clase que encapsula el manejo del concepto Cliente
 * Autor: Pasteleria
 *************************************************************/
error_reporting(E_ALL);
include_once("Usuario.php");


class Cliente extends Usuario {
private string $sRFC="";
private string $sNombreRazSoc="";
private string $sDomFiscal="";
private string $sDomEntrega="";
private string $sNumTel="";
private array $arrCompras=array();


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
				$sQuery = " SELECT t1.scorreo, t2.snombrerazsoc, t2.srfc, 
								   t2.sdomfiscal, t2.sdomentrega, t2.snumtel,
								   t2.sclaveregfiscal, t2.sclaveuso
							FROM usuario t1
							JOIN Cliente t2 ON t2.scorreo = t1.scorreo
							WHERE t1.scorreo = :pCorreo
							AND t1.scontrasenia = :pPwd
							AND t1.bActivo = true";
				$arrParams = array(":pCorreo"=>$this->sCorreo,
								   ":pPwd"=>$this->sContrasenia);
				$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery, $arrParams);
				$oAccesoDatos->desconectar();
				if ($arrRS){
					$this->sCorreo = $arrRS[0][0];
					$this->sNombreRazSoc = $arrRS[0][1];
					$this->sRFC = $arrRS[0][2];
					$this->sDomFiscal = $arrRS[0][3];
					$this->sDomEntrega = $arrRS[0][4];
					$this->sNumTel = $arrRS[0][5];
					$this->oRegFiscal->setClave($arrRS[0][6]);
					$this->oUsoCFDI->setClave($arrRS[0][7]);
					$this->bActivo = true;
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
	
	public function getNombreRazSoc():string{
       return $this->sNombreRazSoc;
    }
	public function setNombreRazSoc(string $valor){
       $this->sNombreRazSoc = $valor;
    }
	
	public function getDomEntrega():string{
       return $this->sDomEntrega;
    }
	public function setDomEntrega(string $valor){
       $this->sDomEntrega = $valor;
    }
	
	public function getNumTel():string{
       return $this->sNumTel;
    }
	public function setNumTel(string $valor){
       $this->sNumTel = $valor;
    }
	
	
}
?>