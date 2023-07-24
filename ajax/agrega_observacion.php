<?php
require_once("../class/safer.class.php");

$id_usuario = $_POST['id_usuario'];
$folio = "";//$_POST['folio'];
$fecha = $_POST['fecha'];
$numero = $_POST['numero'];
$area = $_POST['area'];
$puesto = $_POST['puesto'];
$comportamiento = $_POST['comportamiento'];
$aspectos = $_POST['aspectos'];
$departamento = $_POST['departamento'];
$tipo = $_POST['tipo'];
$criticidad = $_POST['criticidad'];
$descripcion = $_POST['descripcion'];
$acciones = $_POST['acciones'];
$proceso = $_POST['pro'];

$obj=new Safer();

//VERIFICAMOS EL PROCESO

switch($proceso){
	case '1': //registrar
		if($obj->conecta())
		{
			$agrega = $obj->agregaObservacion($id_usuario,$folio,$fecha,$numero,$area,$puesto,$comportamiento,$aspectos,$departamento,$tipo,$criticidad,$descripcion,$acciones);
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