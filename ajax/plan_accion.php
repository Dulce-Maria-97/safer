<?php
@session_start();

require_once("../class/safer.class.php");
$id_usuario = $_SESSION["usuario"];

$folio = $_POST['folio'];
$definir = $_POST['definir_p'];
$fecha_compromiso = $_POST['fecha_compromiso_p'];
$proceso = $_POST['pro_pa'];

$obj=new Safer();

//VERIFICAMOS EL PROCESO

switch($proceso){
	case '1': //registrar
		if($obj->conecta())
		{
			$agrega = $obj->planAccion($id_usuario, $folio, $definir, $fecha_compromiso);
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
}
?>