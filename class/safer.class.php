<?php
class Safer
{
	//
	private $conector;
	private $Servidor;
	private $BaseDatos;
	private $Usuario;
	private $Clave;
	
	function solicitaAutorizacion($id_usuario, $folio, $p_accion, $t_solucion, $consecuencia, $presupuesto)
	{
		$sql = "INSERT INTO autorizacion
           (id_usuario
		   ,id_observacion
           ,plan_de_accion
           ,tiempo_solucion
           ,consecuencia_no_corregir
           ,presupuesto_requerido
           ,estatus)
     VALUES
           ('$id_usuario'
		   ,'$folio'
           ,'$p_accion'
           ,'$t_solucion'
           ,'$consecuencia'
           ,'$presupuesto'
           ,'1')";
		$res=sqlsrv_query($this->conector,$sql);
		
		//Actualiza estado de observacion a 2 En autorizacion
		$sql = "UPDATE r_observaciones SET estatus = 2 WHERE id_observacion = '$folio'";
		$res2=sqlsrv_query($this->conector,$sql);
		
		if ($res && $res2)
			return 1;
		else
			return 0;
	}
	
	function planAccion($id_usuario, $folio, $definir, $fecha_compromiso)
	{
		$sql = "INSERT INTO plan_accion
           (id_usuario
		   ,id_observacion
           ,definir
           ,fecha_compromiso)
     VALUES
           ('$id_usuario'
		   ,'$folio'
           ,'$definir'
           ,'$fecha_compromiso')";
		$res=sqlsrv_query($this->conector,$sql);
		
		//Actualiza estado de observacion a 3 Plan de Accion
		$sql = "UPDATE r_observaciones SET estatus = 3 WHERE id_observacion = '$folio'";
		$res2=sqlsrv_query($this->conector,$sql);
		
		if ($res && $res2)
			return 1;
		else
			return 0;
	}	
	
	function agregaObservacion($id_usuario,$folio,$fecha,$numero,$area,$puesto,$comportamiento,$aspectos,$departamento,$tipo,$criticidad,$descripcion,$acciones)
	{
		//invertir fecha
		$porcion = explode("/", $fecha);
		$fecha = $porcion[2]."/".$porcion[1]."/".$porcion[0];
		
		$sql = "INSERT INTO r_observaciones
           (fecha
           ,id_usuario
           ,id_area
           ,id_puesto
           ,id_comportamiento
           ,id_aspecto
           ,id_departamento
           ,id_tipo_observacion
           ,id_criticidad
           ,descripcion
           ,acciones_realizadas
		   ,estatus)
     VALUES
           ('$fecha'
           ,'$id_usuario'
           ,'$area'
           ,'$puesto'
           ,'$comportamiento'
           ,'$aspectos'
           ,'$departamento'
           ,'$tipo'
           ,'$criticidad'
           ,'$descripcion'
           ,'$acciones'
		   ,'1')";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}
		 
	function archivaObservacion($id_observacion, $comentario, $ruta_imagen, $id_usuario)
	{
		
		$sql = "INSERT INTO archivado
           (id_observacion
           ,comentario
           ,ruta_imagen
           ,id_usuario)
     VALUES
           ('$id_observacion'
           ,'$comentario'
           ,'$ruta_imagen'
           ,'$id_usuario')";
		   
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}
	
	function autorizaObservacion($id_observacion, $id_usuario)
	{
		
		$sql = "UPDATE autorizacion SET id_usuario_autoriza = $id_usuario WHERE id_observacion = $id_observacion";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}	
	
			   	
	//agregar todos los insertan a las tablas 
	function agregaUsuario($nombre, $apellidos, $numero, $correo, $genero, $departamento, $puesto, $rol, $password1)
	{
		$sql = "INSERT INTO usuarios
           (nombre
           ,apellidos
           ,num_empleado
           ,email
           ,contrasena
           ,sexo
           ,id_puesto
           ,id_departamento
           ,id_rol
           ,estatus)
     VALUES
           ('$nombre',
           '$apellidos',
           '$numero',
           '$correo',
           '$password1',
           '$genero',
           '$puesto',
           '$departamento',
           '$rol',
           '1');";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}
	
	function agregaArea($area)
	{
		$sql = "INSERT INTO area (nombre_area,estatus) VALUES ('$area','1');";
		//ejecucion
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	} 
	
	function agregaAutorizacion($auto)
	{
		$sql = "INSERT INTO autorizacion
		 (id_autorizacion,
		id_observacion,
		plan_de_accion,
		tipo_solucion,	
		consecuencia,
	     presupuesto,) 
		 VALUES 
		 ('$p_accion',
		 't_solucion',
		 'consecuencia',
		 't_solucion',
		 'presu',
		 '1');";
		//ejecucion
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	} 
		
	function agregaDepartamento($dep)
	{
		$sql = "INSERT INTO departamento (nombre_departamento,estatus) VALUES ('$dep','1');";
		//ejecucion
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	} 	
	
	function estadoPuesto($id_puesto, $edo)
	{
		$sql = "UPDATE puesto
           SET estatus = '$edo'
     WHERE
           id_puesto = $id_puesto;";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}
		
	function agregaPuesto($pues)
	{
		$sql = "INSERT INTO puesto (puesto,estatus) VALUES ('$pues','1');";
		//ejecucion
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	} 	
	
	function actualizaPuesto($id_puesto, $nombre_puesto)
	{
		$sql = "UPDATE puesto SET puesto = '$nombre_puesto' WHERE id_puesto = $id_puesto;";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}	
	
	
	function agregaAspecto($asp)
	{
		$sql = "INSERT INTO aspecto (aspectos,estatus) VALUES ('$asp','1');";
		//ejecucion
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	} 	
	
	
	function agregaComportamiento($com)
	{
		$sql = "INSERT INTO comportamientos (nombre_comportamiento,estatus) VALUES ('$com','1');";
		//ejecucion
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	} 	
	//fin de bloque guardado
	
	function actualizaComportamiento($id_comportamiento, $comportamiento)
	{
		$sql = "UPDATE comportamientos SET nombre_comportamiento = '$comportamiento' WHERE id_comportamiento = $id_comportamiento;";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}	
	
	function estadoComportamiento($id, $edo)
	{
		$sql = "UPDATE comportamientos
           SET estatus = '$edo'
     WHERE
           id_comportamiento = $id;";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}			
		
	//actualiza editar 
	function actualizaUsuario($id_usuario, $nombre, $apellidos, $numero, $correo, $genero, $departamento, $puesto, $rol, $password1)
	{
		$sql = "UPDATE usuarios
           SET nombre = '$nombre'
           ,apellidos = '$apellidos'
           ,num_empleado = $numero
           ,email = '$correo'
           ,contrasena = '$password1'
           ,sexo = '$genero'
           ,id_puesto = $puesto
           ,id_departamento = $departamento
           ,id_rol = $rol
     WHERE
           id_usuario = $id_usuario;";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}	
	
	function actualizaArea($id_area, $nombre_area)
	{
		$sql = "UPDATE area SET nombre_area = '$nombre_area' WHERE id_area = $id_area;";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}	
	
	function actualizaAspecto($id_aspecto, $aspectos)
	{
		$sql = "UPDATE aspecto SET aspectos = '$aspectos' WHERE id_aspecto = $id_aspecto;";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}
	
	function actualizaDepartamento($id_departamento, $nombre_departamento)
	{
		$sql = "UPDATE departamento SET nombre_departamento = '$nombre_departamento' WHERE id_departamento = $id_departamento;";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}	
	
	
	
	//fin de bloque actualiza editar 
	
	
	//actualiza estado estatus de usuario 
	function estadoUsuario($id_usuario, $edo)
	{
		$sql = "UPDATE usuarios
           SET estatus = '$edo'
     WHERE
           id_usuario = $id_usuario;";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}	
	
	function estadoArea($id_area, $edo)
	{
		$sql = "UPDATE area
           SET estatus = '$edo'
     WHERE
           id_area = $id_area;";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}	
	
	function estadoDepartamento($id_departamento, $edo)
	{
		$sql = "UPDATE departamento
           SET estatus = '$edo'
     WHERE
           id_departamento = $id_departamento;";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}		
	
	//actualiza estado estatus
	
	function getNombreUsuario($id_usuario){
		$sql = "SELECT nombre FROM usuarios WHERE id_usuario = $id_usuario";
		
		if ($this->conecta())
		{
			$res=sqlsrv_query($this->conector,$sql);
			while ($fila = sqlsrv_fetch_array($res))
			{
				return $fila["nombre"];
			}		
			return "";
		}
	}
	
	function getNombreComUsuario($id_usuario){
		$sql = "SELECT CONCAT(nombre,' ',apellidos) as nombre FROM usuarios WHERE id_usuario = $id_usuario";

		$res=sqlsrv_query($this->conector,$sql);
		while ($fila = sqlsrv_fetch_array($res))
		{
			return $fila["nombre"];
		}		
		return "";
		
	}
	
	function getTipoObserv($id_tipo){
		$sql = "SELECT observacion FROM tipos_observacion WHERE id_tipo_observacion = $id_tipo";

		$res=sqlsrv_query($this->conector,$sql);
		while ($fila = sqlsrv_fetch_array($res))
		{
			return $fila["observacion"];
		}		
		return "";
		
	}		
	
	function getNumEmpleado($id_usuario){
		$sql = "SELECT num_empleado FROM usuarios WHERE id_usuario = $id_usuario";
		
		$res=sqlsrv_query($this->conector,$sql);
		while ($fila = sqlsrv_fetch_array($res))
		{
			return $fila["num_empleado"];
		}		
		return "";
		
	}		
	
	function getRolUsuario($id_usuario){
		$sql = "SELECT id_rol FROM usuarios WHERE id_usuario = $id_usuario";
		
		if ($this->conecta())
		{
			$res=sqlsrv_query($this->conector,$sql);
			while ($fila = sqlsrv_fetch_array($res))
			{
				return $fila["id_rol"];
			}		
			return "";
		}
	}	
		
	//Metodo de proceso de edicon 
	function getDatosUsuario($id_usuario){
		$sql = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getDatosObservacion($id_observacion){
		$sql = "SELECT * FROM r_observaciones Where id_observacion = $id_observacion";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getDatosAutorizacion($id_observacion){
		$sql = "SELECT top 1 * FROM autorizacion Where id_observacion = $id_observacion";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getDatosPlanAccion($id_observacion){
		$sql = "SELECT top 1 * FROM plan_accion where id_observacion = $id_observacion order by id_plan_accion desc";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getDatosArchivado($id_observacion){
		$sql = "SELECT top 1 * FROM archivado where id_observacion = $id_observacion order by id_archivado desc";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}					
	
	function getDatosAspecto($id_aspecto){
		$sql = "SELECT * FROM aspecto WHERE id_aspecto = $id_aspecto";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getDatosDepartamento($id_departamento){
		$sql = "SELECT * FROM departamento WHERE id_departamento = $id_departamento";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}	
	//Metodo de proceso de edicon
	
	//Procesos de todos los select del formulario 
	function getPuesto($id_puesto)
	{
		$sql = "SELECT puesto FROM puesto WHERE id_puesto = $id_puesto";
		$res=sqlsrv_query($this->conector,$sql);
		while ($fila = sqlsrv_fetch_array($res))
		{
			return $fila["puesto"];
		}		
		return "";
	}
	

	
	function getRol($id_rol)
	{
		$sql = "SELECT rol FROM rol WHERE id_rol = $id_rol";
		$res=sqlsrv_query($this->conector,$sql);
		while ($fila = sqlsrv_fetch_array($res))
		{
			return $fila["rol"];
		}		
		return "";
	}
	
	function getArea($id_area)
	{
		$sql = "SELECT nombre_area FROM area WHERE id_area = $id_area";
		$res=sqlsrv_query($this->conector,$sql);
		while ($fila = sqlsrv_fetch_array($res))
		{
			return $fila["nombre_area"];
		}		
		return "";
	}	
	
	
	function getAspecto($id_aspecto)
	{
		$sql = "SELECT aspectos FROM aspecto WHERE id_aspecto = $id_aspecto";
		$res=sqlsrv_query($this->conector,$sql);
		while ($fila = sqlsrv_fetch_array($res))
		{
			return $fila["aspectos"];
		}		
		return "";
	}	
	
	//selecion de la vista 
	function getAspectos(){
		$sql = "SELECT * FROM aspecto";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}	
	
	function estadoAspecto($id_aspecto, $edo)
	{
		$sql = "UPDATE aspecto
           SET estatus = '$edo'
     WHERE
           id_aspecto = $id_aspecto;";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}	
	
	function estadoObservacion($id_observacion, $edo)
	{
		$sql = "UPDATE r_observaciones
           SET estatus = '$edo'
     WHERE
           id_observacion = $id_observacion;";
		$res=sqlsrv_query($this->conector,$sql);
		
		if ($res)
			return 1;
		else
			return 0;
	}			
	
	
	function getDepartamento($id_departamento)
	{
		$sql = "SELECT nombre_departamento FROM departamento WHERE id_departamento = $id_departamento";
		$res=sqlsrv_query($this->conector,$sql);
		while ($fila = sqlsrv_fetch_array($res))
		{
			return $fila["nombre_departamento"];
		}		
		return "";
	}	
	
	function getComportamiento($id_com)
	{
		$sql = "SELECT nombre_comportamiento FROM comportamientos WHERE id_comportamiento = $id_com";
		$res=sqlsrv_query($this->conector,$sql);
		while ($fila = sqlsrv_fetch_array($res))
		{
			return $fila["nombre_comportamiento"];
		}		
		return "";
	}	
	
	function getCriticidad($id_criticidad)
	{
		$sql = "SELECT nombre FROM criticidad WHERE id_criticidad = $id_criticidad";
		$res=sqlsrv_query($this->conector,$sql);
		while ($fila = sqlsrv_fetch_array($res))
		{
			return $fila["nombre"];
		}		
		return "";
	}	
	///Procesos de todos los select del formulario 
	
	
	 
	
	//selecion de la vista 
	function getUsuarios(){
		$sql = "SELECT * FROM usuarios";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getObservaciones(){
		$sql = "SELECT * FROM r_observaciones";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getObservacionesUser($id_usuario){
		$sql = "SELECT * FROM r_observaciones WHERE id_usuario = $id_usuario";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}	
	
		function getAutorizaciones(){
		$sql = "SELECT * FROM autorizacion";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getPlan_accion(){
		$sql = "SELECT * FROM plan_accion";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	
	function getAreas(){
		$sql = "SELECT * FROM area";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getTipoObservacion(){
		$sql = "SELECT * FROM tipos_observacion";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getCriticidades(){
		$sql = "SELECT * FROM criticidad";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}	
		
	function getDepartamentos(){
		$sql = "SELECT * FROM departamento";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getRoles(){
		$sql = "SELECT * FROM rol";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getPuestos(){
		$sql = "SELECT * FROM puesto";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getComportamientos(){
		$sql = "SELECT * FROM comportamientos";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}	
	
	
	
		
	//get de las tablas de vista 
	
	
	
	//Procesos de todos los select del formulario 
	function existeCorreo($correo)
	{
		$sql = "select * from usuarios where email LIKE '%$correo%'";
		$res=sqlsrv_query($this->conector,$sql);
		while ($fila = sqlsrv_fetch_array($res))
		{
			return 777;
		}		
		return 0;
	}
	
	function valida_usuario($usuario, $pw)
	{
		$sql = "SELECT id_usuario from usuarios where email = '$usuario' and contrasena = '$pw'";
		$res=sqlsrv_query($this->conector,$sql);//ejecuta
		
		while ($fila = sqlsrv_fetch_array($res))//si hay registros
		{
			return $fila["id_usuario"];//regreso el email
		}		
		return 0;//en caso contrario el 0
	}
	
	//permisos modulos menu
	function getModulosRol($id_rol){
		$sql = "select * from modulo inner join r_rol_mod on modulo.id_modulo = r_rol_mod.id_modulo Where id_rol = $id_rol";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}
	
	function getMenusRolMod($id_rol, $id_modulo){
		$sql = "select * from r_rol_menu inner join menu on r_rol_menu.id_menu = menu.id_menu WHERE id_rol = $id_rol and id_modulo=$id_modulo";
		$datos=sqlsrv_query($this->conector,$sql);
		return $datos;
	}	
	
	function getNombreRol($id_rol)
	{
		if ($this->conecta())
		{
			$sql = "SELECT * FROM rol where id_rol = $id_rol";
			$res=sqlsrv_query($this->conector,$sql);//ejecuta
			
			while ($fila = sqlsrv_fetch_array($res))//si hay registros
			{
				return $fila["rol"];//regreso el email
			}		
			return "";//en caso contrario el 0
		}
	}		
	//permisos modulos menu
	
	//Constructor
	function __construct()
	{
		$this->Servidor = "DESKTOP-KH4811V"; //"localhost"; 
		$this->BaseDatos = "SAFERMANY";
		$this->Usuario = "safer"; 
		$this->Clave = "1234";
	}
	
	//verifica la conexion a la bd
	function conecta()
	{		
		$connectionInfo = array( "Database"=>$this->BaseDatos, "UID"=>$this->Usuario, "PWD"=>$this->Clave, "CharacterSet"=>"UTF-8");
		$this->conector = sqlsrv_connect( $this->Servidor, $connectionInfo);
		
		if( $this->conector ) {
			 return 1;
		}else{
			 return 0;
			 die( print_r( sqlsrv_errors(), true));
		}
	}
}