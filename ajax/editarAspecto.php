<!--Metodo de boton edicion -->
<?php
	$id_usuario = $_POST['id_aspecto'];

	require ("../class/safer.class.php");
	$obj = new Safer();
	if($obj->conecta())
	{
		$datos = $obj->getDatosUsuario($id_aspecto);
		while ($fila = sqlsrv_fetch_array($datos))
        {
			$id_aspecto = $fila['id_aspecto'];
			$aspecto= $fila['aspectos'];
			$estatus = $fila['estatus'];
		}
	}

$datos = array(
				0 => $id_aspecto,
				1 => $aspecto,
				2 => $estatus
				);
echo json_encode($datos);
?>

<!--Metodo de boton edicion -->