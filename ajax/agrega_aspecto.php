<?php
require_once("../class/safer.class.php");

$aspecto=$_POST['aspecto'];


$proceso = $_POST['pro'];


$obj=new Safer();

//VERIFICAMOS EL PROCESO

switch($proceso){
	case '1': //registrar
		if($obj->conecta())
		{
			$agrega = $obj->agregaAspecto($aspecto);
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
	
	$id_aspecto = $_POST['id_aspecto'];
		if($obj->conecta())
		{
			$actualiza = $obj->actualizaAspecto($id_aspecto, $aspecto);
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