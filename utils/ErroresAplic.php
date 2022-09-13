<?php
/*
Archivo:  ErroresAplic.php
Objetivo: clase que encapsula los errores que maneja la aplicación
Autor:    Mijangos Gálvez Jafet
*/
class ErroresAplic{
	private int $nError=-1;
	//Errores considerados
	CONST NO_FIRMADO = 1;
	CONST USR_DESCONOCIDO = 2;
	CONST ERROR_EN_BD = 3;
	CONST FALTAN_DATOS = 4;
	CONST NO_EXISTE_BUSCADO = 5;
	CONST SIN_PERMISOS = 6;
	CONST ERROR_DATOS = 7;
	CONST ERROR_NAV = 8;
	CONST ARCH_NO_COPIADO = 9;
	CONST ARCH_MAYOR = 10;
	CONST ARCH_TIPO_MAL = 11;
	CONST ARCH_PROBL = 12;
	CONST ERROR_URL = 13;
	CONST ERROR_CORREO = 14;
	CONST ERROR_PASSWORD = 15;
	CONST ERROR_FORMATO = 16;
	CONST ERROR_HORA = 17;
	CONST ERROR_FECHA = 18;
	CONST TIPO_PROD_INEXISTENTE = 19;
	
	public function getError(){
		return $this->nError;
	}
	public function setError(int $val){
		$this->nError = $val;
	}
	
	public function getTextoError(){
	$sMsjError = "";
		switch ($this->nError){
			case self::NO_FIRMADO: $sMsjError = "No ha ingresado al sistema";
									break;
			case self::USR_DESCONOCIDO: $sMsjError ="Usuario desconocido";
									break;
			case self::ERROR_EN_BD: $sMsjError ="Error al acceder al repositorio";
									break;
			case self::FALTAN_DATOS: $sMsjError = "Faltan datos";
									break;
			case self::NO_EXISTE_BUSCADO: $sMsjError = "No existe el registro buscado";
									break;
			case self::SIN_PERMISOS: $sMsjError = "No tiene permisos para ver la pantalla solicitada";
									break;
			case self::ERROR_DATOS: $sMsjError = "Los datos son de tipo erróneo";
									break;
			case self::ERROR_NAV: $sMsjError = "Error de navegación";
									break;
			case self::ARCH_MAYOR: $sMsjError = "El archivo es mayor a 200 KB";
									break;
			case self::ARCH_TIPO_MAL: $sMsjError = "El archivo es de tipo incorrecto";
									break;
			case self::ARCH_PROBL: $sMsjError = "El archivo presenta problemas";
									break;
			case self::ERROR_URL: $sMsjError = "Error de Formato de URL";
									break;
			case self::ERROR_CORREO: $sMsjError = "Error de Formato de Correo o faltan datos";
									break;
		    case self::ERROR_PASSWORD: $sMsjError = "Error de Formato de Contraseña";
									break;
			case self::ERROR_FORMATO: $sMsjError = "Error en el Formato Solicitado";
									break;
			case self::ERROR_HORA: $sMsjError = "Error en el Formato de Hora";
									break;
			case self::ERROR_FECHA: $sMsjError = "Error en el Formato de Fecha";
									break;
			case self::TIPO_PROD_INEXISTENTE: $sMsjError = "El tipo de producto es incorrecto";
									break;
			default: $sMsjError = "Error desconocido";
		}
		return $sMsjError;
	}
}
?>