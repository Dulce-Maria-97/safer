<?php
	$id_observacion = $_POST['id_observacion'];
	require ("../class/safer.class.php");
	$obj = new Safer();
	if($obj->conecta())
	{
		$datos = $obj->getDatosObservacion($id_observacion);
		while ($fila = sqlsrv_fetch_array($datos))
        {
			$fecha = $fila["fecha"]->format('d-m-Y'); 
			$id_area = $fila["id_area"];
			$area = $obj->getArea($id_area);
			$id_usuario = $fila["id_usuario"];		
			$num = $obj->getNumEmpleado($id_usuario);
			$nombre = $obj->getNombreComUsuario($id_usuario);
			$id_puesto = $fila['id_puesto'];
			$puesto =  $obj->getPuesto($id_puesto);
			$descripcion = $fila['descripcion'];
			$acciones = $fila['acciones_realizadas'];
			$id_tipo_observacion = $fila['id_tipo_observacion'];
			$tipo_observacion = $obj->getTipoObserv($id_tipo_observacion);
			$id_aspecto = $fila['id_aspecto'];
			$aspectos = $obj->getAspecto($id_aspecto);
			$id_comportamiento = $fila['id_comportamiento'];
			$comportamientos = $obj->getComportamiento($id_comportamiento);
			$id_criticidad = $fila['id_criticidad'];
			$criticidad = $obj->getCriticidad($id_criticidad);
			$id_departamento = $fila['id_departamento'];
			$departamento = $obj->getDepartamento($id_departamento);
			$estado = $fila["estatus"];	
		}
	}

$datos = array(
				0 => $id_observacion,				
				1 => $fecha, 
				2 => $id_area,
				3 => $area,
				4 => $id_usuario,    
				5 => $num,
				6 => $nombre,
				7 => $id_puesto,
				8 => $puesto,
				9 => $descripcion,
				10 => $acciones,
				11 => $id_tipo_observacion,
				12 => $tipo_observacion,
				13 => $id_aspecto,
				14 => $aspectos,
				15 => $id_comportamiento,
				16 => $comportamientos,
				17 => $id_criticidad,
				18 => $criticidad,
				19 => $id_departamento,
				20 => $departamento,
				21 => $estado				
				);
echo json_encode($datos);
?>