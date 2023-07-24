<!--conecion a la base de datos -->
<?php
	require ("../class/safer.class.php");
	$obj = new Safer();
	$id_usuario = $_POST["id_usuario"];
?>
<!--conecion a la base de datos -->

<table id="observaciones" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                         <th>Folio</th>
                          <th>Fecha</th>
                          <!--<th>Núm. de empleado</th>
                          <th>Nombre de empleado</th>-->
                          <th>Área de observación</th>
                          <th>Observación Realizada a </th>
                          <!--<th>Descripción</th>
                          <th>Acciones </th>-->
                          <th>Tipo de Observación</th>
                          <!--<th>Aspectos</th>
                          <th>Comportamientos</th>-->
                          <th>Criticidad</th>
                          <th>Responsable Seguimiento</th> 
                          <th>Estado</th>
                          <th>Opciones</th>

                        </tr>
                      </thead>


                      <tbody>
                        
                      <?php
						if ($obj->conecta())
						{
							$datos = $obj->getObservaciones();
							while ($fila = sqlsrv_fetch_array($datos))
							{
								$id = $fila["id_observacion"];
								$fecha = $fila["fecha"]->format('Y-m-d'); 
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
								
								if ($estado != 0 && $estado != 2 && $estado != 4)
									continue;
										
								echo "<tr>";
								echo "<td>$id</td>";
								echo "<td>";
								echo "$fecha";								
								echo "</td>";
								//echo "<td>$num</td>";
								//echo "<td>$nombre</td>";
								echo "<td>$area</td>";
								echo "<td>$puesto</td>";
								//echo "<td>$descripcion</td>";
								//echo "<td>$acciones</td>";
								echo "<td>$tipo_observacion</td>";
								//echo "<td>$aspectos</td>";
								//echo "<td>$comportamientos</td>";
								echo "<td>$criticidad</td>";
								echo "<td>$departamento $estado</td>";
								
								
								
								
								if ($estado==1)
									echo $es= "<td class='edo mano  text-center' alt='$id' rel='$estado'><b><i class='fa fa-check'></i> Generada</b></td>";	
								else if ($estado==2)
									echo $es= "<td class='success text-center' alt='$id' rel='$estado'><b><i class='fa fa-check'></i> En Autorización</b></td>";		
								else if ($estado==3)
									echo $es= "<td class='primary text-center' alt='$id' rel='$estado'><b><i class='fa fa-check'></i> Plan de Acción</b></td>";			
								else if ($estado==4)
									echo $es= "<td class='info text-center' alt='$id' rel='$estado'><b><i class='fa fa-check'></i> Autorizada</b></td>";			
								else
									echo $es= "<td class='mano danger text-center' alt='$id' rel='$estado'><b><i class='fa fa-times'></i> Rechazada</b></td>";
									
													
								  echo "<td>";
								  
								  if ($estado == 2)
								  	echo "<button class='validar btn btn-round btn-success' alt='$id' alt2='$estado' rel='$nombre' title='Autorizar'><i class='fa fa-check'></i></button>";
								  else
								  	echo "<button class='validar btn btn-round btn-info' alt='$id' alt2='$estado' rel='$nombre' title='Ver Detalle'><i class='fa fa-eye'></i></button>";	
								  /*echo "<button class='btn btn-round btn-danger'>Eliminar</button>";*/
								  
								  
								  echo "</td>";
								echo "</tr>";
								
							}
						}

                      ?>                        
                      </tbody>
                    </table>
                    
<script>



 //boton nuevo registro
$('#nuevo').on('click',function(){
	$('#formulario')[0].reset();//limpiar formulario de campos y valores 
	$('#contenido').find('input, textarea, button, select').removeAttr('disabled');//desbloquear elementos de usuarios 
	$('#titulo').text('Agregar:');
	$('#pro').val('1');
	$('#edi').hide();
	$('#reg').show();
	
	$('#registrar').modal({
		show:true,
		backdrop:'static'
	});
});
//boton nuevo registro

//funcion para editar
$('.validar').click(function(){	
	var ob=$(this);
	var id = ob.attr("alt");
	var estado = ob.attr("alt2");
	
	if (estado == 2){
		$("#autorizar").attr('disabled', false);
		$("#rechazar").attr('disabled', false);
		$("#autorizar").show();
		$("#rechazar").show();
	}
	else
	{
		$("#autorizar").attr('disabled', true);
		$("#rechazar").attr('disabled', true);
		$("#autorizar").hide();
		$("#rechazar").hide();
	}
	
	var url = 'ajax/editarObservacionAutorizacion.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id_observacion='+id,
		beforeSend: function() {//antes de enviar
			$('#mloading').modal({ keyboard: false, backdrop:'static',});
		},
		success: function(valores){
			//alert (valores);
			var datos = eval(valores);
			$('#folio').val(datos[0]);
			$('#fecha').val(datos[1]);
			$('#numero').val(datos[5]);
			$('#nombre_empleado').val(datos[6]);
			$('#area').val(datos[2]);
			$('#puesto').val(datos[7]);
			$('#comportamiento').val(datos[15]);
			$('#aspectos').val(datos[13]);
			$('#departamento').val(datos[19]);
			$('#tipo').val(datos[11]);
			$('#criticidad').val(datos[17]);
			$('#descripcion').val(datos[9]);
			$('#acciones').val(datos[10]);
			$('#p_accion').val(datos[22]);
			$('#t_solucion').val(datos[23]);
			$('#consecuencia').val(datos[24]);
			$('#presupuesto').val(datos[25]);
			
			

			$('#registrar').modal({
				show:true,
				backdrop:'static'
			});
		},
		complete: function() {
			$('#mloading').modal('hide');
		}
	});	
});

</script>