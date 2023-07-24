<?php
require_once("../class/safer.class.php");

$pues=$_POST['pues'];


$proceso = $_POST['pro'];


$obj=new Safer();

//VERIFICAMOS EL PROCESO

switch($proceso){
	case '1': //registrar
		if($obj->conecta())
		{
			$agrega = $obj->agregaPuesto($pues);
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

	break;
}
?>