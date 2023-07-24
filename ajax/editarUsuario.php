<?php
	$id_usuario = $_POST['id_usuario'];

	require ("../class/safer.class.php");
	$obj = new Safer();
	if($obj->conecta())
	{
		$datos = $obj->getDatosUsuario($id_usuario);
		while ($fila = sqlsrv_fetch_array($datos))
        {
			$id_usuario = $fila['id_usuario'];
			$nombre = $fila['nombre'];
			$apellidos = $fila['apellidos'];
			$num_empleado = $fila['num_empleado'];
			$email = $fila['email'];
			$contrasena = $fila['contrasena'];
			$genero = $fila['sexo'];
			$id_puesto = $fila['id_puesto'];
			$id_departamento = $fila['id_departamento'];
			$id_rol = $fila['id_rol'];
			$estatus = $fila['estatus'];
		}
	}

$datos = array(
				0 => $id_usuario,
				1 => $nombre, 
				2 => $apellidos, 
				3 => $num_empleado, 
				4 => $email, 
				5 => $contrasena,
				6 => $genero,
				7 => $id_puesto,
				8 => $id_departamento,
				9 => $id_rol,
				10 => $estatus
				);
echo json_encode($datos);
?>