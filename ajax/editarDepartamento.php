<!--Metodo de boton edicion -->
<?php
	$id_usuario = $_POST['id_departamento'];

	require ("../class/safer.class.php");
	$obj = new Safer();
	if($obj->conecta())
	{
		$datos = $obj->getDatosUsuario($id_departamento);
		while ($fila = sqlsrv_fetch_array($datos))
        {
			$id_departamento = $fila['id_departamento'];
			$departamento = $fila['nombre_id_departamento'];
			$estatus = $fila['estatus'];
		}
	}

$datos = array(
				0 => $id_departamento,
				1 => $departamento,
				2 => $estatus
				);
echo json_encode($datos);
?>

<!--Metodo de boton edicion -->