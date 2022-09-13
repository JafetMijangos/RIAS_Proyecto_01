<?php
/*************************************************************
 * Usuario.php
 * Objetivo: clase que encapsula el manejo del concepto Usuario
 *			(clase abstracta creada para manejar los elementos
 *           comunes que existen entre empleados y clientes, es
 *			 decir, entre todos los que pueden ingresar al 
 *			 sistema con una clave y una contraseña)
 * Autor: Pasteleria
 *************************************************************/
error_reporting(E_ALL);
include_once("AccesoDatos.php");

abstract class Usuario {
protected string $sCorreo="";
protected string $sContrasenia="";


	abstract public function buscarCvePwd():bool;

	abstract public function buscar(): bool;

	abstract public function buscarTodos():array;

	abstract public function insertar():int;

	abstract public function modificar():int;

	abstract public function eliminar():int;
	

    public function getCorreo():string{
       return $this->sCorreo;
    }
	public function setCorreo(string $valor){
       $this->sCorreo = $valor;
    }
    
    public function getContrasenia():string{
       return $this->sContrasenia;
    }
	public function setContrasenia(string $valor){
       $this->sContrasenia = $valor;
    }
}
?>