<!--Metodo de boton edicion -->
<?php
	$id_usuario = $_POST['id_area'];

	require ("../class/safer.class.php");
	$obj = new Safer();
	if($obj->conecta())
	{
		$datos = $obj->getDatosUsuario($id_area);
		while ($fila = sqlsrv_fetch_array($datos))
        {
			$id_area = $fila['id_area'];
			$area = $fila['nombre_area'];
			$estatus = $fila['estatus'];
		}
	}

$datos = array(
				0 => $id_area,
				1 => $area,
				2 => $estatus
				);
echo json_encode($datos);
?>

<!--Metodo de boton edicion -->