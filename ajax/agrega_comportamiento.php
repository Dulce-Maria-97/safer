<?php
require_once("../class/safer.class.php");

$comportamiento=$_POST['comportamiento'];


$proceso = $_POST['pro'];


$obj=new Safer();

//VERIFICAMOS EL PROCESO

switch($proceso){
	case '1': //registrar
		if($obj->conecta())
		{
			$agrega = $obj->agregaComportamiento($comportamiento);
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
		$id_comportamiento = $_POST['id_comportamiento'];
		if($obj->conecta())
		{
			$actualiza = $obj->actualizaComportamiento($id_comportamiento, $comportamiento);
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