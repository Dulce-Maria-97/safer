<?php	
@session_start();
date_default_timezone_set('America/Mexico_City');

require_once('../class/safer.class.php');
$obj = new Safer();

$user = $_SESSION["usuario"];
$id_observacion = $_POST['id'];
$comentario = $_POST['comentario'];

$upload_folder ="../archivada";	

$nombre_archivo = $_FILES['archivo']['name'];
$tamano_archivo = $_FILES['archivo']['size'];
$tmp_archivo = $_FILES['archivo']['tmp_name'];

$nombreFinal = $id_observacion.".jpg";
$archivador = $upload_folder . '/' . $nombreFinal;

if ($a=move_uploaded_file($tmp_archivo ,$archivador)) {
	//echo "imagen agredada";
	if($obj->conecta())
	{
		$b = $obj->estadoObservacion($id_observacion, 5);
		$c = $obj->archivaObservacion($id_observacion, $comentario, 'archivada/' . $nombreFinal, $user); 
	}
	
	if ($a && $b && $c)
		echo 1;
	else
		echo 0;
}else
	echo 0;
?>