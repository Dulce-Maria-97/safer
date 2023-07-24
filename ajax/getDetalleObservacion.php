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
		//datos autorizacion
		$datosA = $obj->getDatosAutorizacion($id_observacion);
		$numero_autoriza = 0;
		$nombre_autoriza = "";
		$numero_auto = 0;
		$nombre_auto = "";
		$plan_de_accion = "N/A";
		$tiempo_solucion = "N/A";
		$consecuencia_no_corregir = "N/A";
		$presupuesto_requerido = "N/A";
			
		while ($da = sqlsrv_fetch_array($datosA))
		{
			$numero_autoriza = $obj->getNumEmpleado($da["id_usuario"]);
			$nombre_autoriza = $obj->getNombreComUsuario($da["id_usuario"]);
			$numero_auto = $obj->getNumEmpleado($da["id_usuario_autoriza"]);
			$nombre_auto = $obj->getNombreComUsuario($da["id_usuario_autoriza"]);
			$plan_de_accion = $da["plan_de_accion"];
			$tiempo_solucion = $da["tiempo_solucion"];
			$consecuencia_no_corregir = $da["consecuencia_no_corregir"];
			$presupuesto_requerido = $da["presupuesto_requerido"];				
		}
		
		$numero_plan = 0;
		$nombre_plan = "";
		$definir = "";
		$fecha_compromiso = "";
		//plan accion
		$datosP = $obj->getDatosPlanAccion($id_observacion);
		while ($dp = sqlsrv_fetch_array($datosP))
		{
			$numero_plan = $obj->getNumEmpleado($dp["id_usuario"]);
			$nombre_plan = $obj->getNombreComUsuario($dp["id_usuario"]);
			$definir = $dp["definir"];
			$fecha_compromiso = $dp["fecha_compromiso"]->format('d-m-Y'); 		
		}
		
		//Datos archivado
		$usuario_archiva = 0;
		$nombre_archiva = "";
		$comentario_final = "";
		$ruta_imagen = "";
		
		$datosA = $obj->getDatosArchivado($id_observacion);
		while ($da = sqlsrv_fetch_array($datosA))
		{
			$usuario_archiva = $obj->getNumEmpleado($da["id_usuario"]);
			$nombre_archiva = $obj->getNombreComUsuario($da["id_usuario"]);
			$comentario_final = $da["comentario"];
			$ruta_imagen = $da["ruta_imagen"]; 		
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
				21 => $estado,
				22 => $plan_de_accion,
				23 => $tiempo_solucion,
				24 => $consecuencia_no_corregir,
				25 => $presupuesto_requerido,
				26 => $definir,
				27 => $fecha_compromiso,
				28 => $usuario_archiva,
				29 => $comentario_final,	
				30 => $ruta_imagen,
				31 => $numero_autoriza,	
				32 => $nombre_autoriza,
				33 => $numero_plan,	
				34 => $nombre_plan,
				35 => $nombre_archiva,
				36 => $numero_auto,
				37 => $nombre_auto			
				);
echo json_encode($datos);
?>