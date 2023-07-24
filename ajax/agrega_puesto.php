<?php
require_once("../class/safer.class.php");

$puesto=$_POST['puesto'];


$proceso = $_POST['pro'];


$obj=new Safer();

//VERIFICAMOS EL PROCESO

switch($proceso){
	case '1': //registrar
		if($obj->conecta())
		{
			$agrega = $obj->agregaPuesto($puesto);
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
	
	$id_puesto = $_POST['id_puesto'];
		if($obj->conecta())
		{
			$actualiza = $obj->actualizaPuesto($id_puesto, $puesto);
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