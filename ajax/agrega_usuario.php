<?php
require_once("../class/safer.class.php");

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$numero = $_POST['numero'];
$correo = $_POST['correo'];
$genero = $_POST['genero'];
$departamento = $_POST['departamento'];
$puesto = $_POST['puesto'];
$rol = $_POST['rol'];
$password1 = $_POST['password1'];
$proceso = $_POST['pro'];

$obj=new Safer();

//VERIFICAMOS EL PROCESO

switch($proceso){
	case '1': //registrar
		if($obj->conecta())
		{
			//valida que no exista el correo
			$existe = $obj->existeCorreo($correo);
			
			if ($existe ==0){
				$agrega = $obj->agregaUsuario($nombre, $apellidos, $numero, $correo, $genero, $departamento, $puesto, $rol, $password1);
				if($agrega)
					echo 1;
				else
					echo 0;
			
			}else
				echo $existe;	
		}
		else
		{
			return 0;
		}
	break;
	
	case '2'://actualizar
		$id_usuario = $_POST['id_usuario'];
		if($obj->conecta())
		{
			$actualiza = $obj->actualizaUsuario($id_usuario, $nombre, $apellidos, $numero, $correo, $genero, $departamento, $puesto, $rol, $password1);
			if($actualiza)
				echo 1;
			else
				echo 0;
		}
		else
		{
			return 0;
		}

	break;
}
?>

