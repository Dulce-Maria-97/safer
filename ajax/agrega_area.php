<?php
require_once("../class/safer.class.php");

$area=$_POST['area'];


$proceso = $_POST['pro'];


$obj=new Safer();

//VERIFICAMOS EL PROCESO

switch($proceso){
	case '1': //registrar
		if($obj->conecta())
		{
			$agrega = $obj->agregaArea($area);
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
	
	$id_area = $_POST['id_area'];
		if($obj->conecta())
		{
			$actualiza = $obj->actualizaArea($id_area, $area);
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