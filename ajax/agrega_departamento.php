<?php
require_once("../class/safer.class.php");

$dep=$_POST['dep'];


$proceso = $_POST['pro'];


$obj=new Safer();

//VERIFICAMOS EL PROCESO

switch($proceso){
	case '1': //registrar
		if($obj->conecta())
		{
			$agrega = $obj->agregaDepartamento($dep);
			if($agrega)
				echo 1;
			else
				echo 0;
		}
		else
		{
			return 0;
		}
	break;
	
	case '2'://actualizar
$id_departamento = $_POST['id_departamento'];
		if($obj->conecta())
		{
			$actualiza = $obj->actualizaDepartamento($id_departamento, $dep);
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