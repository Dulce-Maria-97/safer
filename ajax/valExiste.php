<?php
$user = $_POST["us"];
$pw = $_POST["pw"];

require("../class/safer.class.php");
$obj = new Safer();

if ($obj->conecta())
{
	$existe= $obj->valida_usuario($user, $pw);
	
	if ($existe =="0")
		echo 2;
	else
	{
		session_start();//inicio variable de sessiion
		$_SESSION["usuario"]=$existe; //declaro una variable de seciob lklamda ususario y le asigno el valro de existe
		$_SESSION["nombre"]=$obj->getNombreUsuario($_SESSION["usuario"]);
		$_SESSION["rol"]=$obj->getRolUsuario($_SESSION["usuario"]);
		echo 1;
	}
}
else
	echo 0;
?>