<?php
@session_start();

require_once("../class/safer.class.php");
$id_usuario = $_SESSION["usuario"];

$folio = $_POST['folio'];
$p_accion = $_POST['p_accion'];
$t_solucion = $_POST['t_solucion'];
$consecuencia = $_POST['consecuencia'];
$presupuesto = $_POST['presupuesto'];
$proceso = $_POST['pro_a'];

$obj=new Safer();

//VERIFICAMOS EL PROCESO

switch($proceso){
	case '1': //registrar
		if($obj->conecta())
		{
			
			$agrega = $obj->solicitaAutorizacion($id_usuario, $folio, $p_accion, $t_solucion, $consecuencia, $presupuesto);
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