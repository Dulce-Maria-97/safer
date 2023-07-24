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
                          <th>Núm. de empleado</th>
                          <th>Nombre de empleado</th>
                          <th>Área de observación</th>
                          <th>Observación Realizada a </th>
                          <th>Descripción</th>
                          <th>Acciones </th>
                          <th>Tipo de Observación</th>
                          <th>Aspectos</th>
                          <th>Comportamientos</th>
                          <th>Criticidad</th>
                          <th>Responsable Seguimiento</th> 
                          <th>Estado</th>
                          <!--<th>Opciones</th>-->

                        </tr>
                      </thead>


                      <tbody>
                        
                      <?php
						if ($obj->conecta())
						{
							$datos = $obj->getObservacionesUser($id_usuario);
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
								
										
								echo "<tr>";
								echo "<td>$id</td>";
								echo "<td>";
								echo "$fecha";								
								echo "</td>";
								echo "<td>$num</td>";
								echo "<td>$nombre</td>";
								echo "<td>$area</td>";
								echo "<td>$puesto</td>";
								echo "<td>$descripcion</td>";
								echo "<td>$acciones</td>";
								echo "<td>$tipo_observacion</td>";
								echo "<td>$aspectos</td>";
								echo "<td>$comportamientos</td>";
								echo "<td>$criticidad</td>";
								echo "<td>$departamento</td>";
								
								
								
								
								if ($estado)
									echo $es= "<td class='edo mano success text-center' alt='$id' rel='$estado'><b><i class='fa fa-check'></i> Activo</b></td>";	
								else
									echo $es= "<td class='edo mano danger text-center' alt='$id' rel='$estado'><b><i class='fa fa-window-close'></i> Inactivo</b></td>";
									
													
								  //echo "<td>";
							//echo "<button class='editar btn btn-round btn-info' alt='$id' rel='$nombre'>Editar</button>";
								  /*echo "<button class='btn btn-round btn-danger'>Eliminar</button>";*/
								  //echo "</td>";
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
$('.editar').click(function(){	
	var ob=$(this);
	var id = ob.attr("alt");
	var campo = ob.attr("rel");
	
	$('#formulario')[0].reset();//reiniciar formulario
	$('#contenido').find('input, textarea, button, select').removeAttr('disabled');
	
	$('#reg').hide();
	$('#edi').show();
	
	$('#titulo').text('Edicion de area:');
	$('#pro').val('2');
	$('#id_comportamiento').val(id);
	$('#comportamiento').val(campo);

	$('#registrar').modal({
		show:true,
		backdrop:'static'
	});
});

//cambio de estado manitas
$(".edo").click(function()
{
	var ob=$(this);
	var id = ob.attr("alt");
	var estado= ob.attr("rel");	
	if (estado==0) est=1;
	if (estado==1) est=0;
	
	$.ajax(
	{
		async:true, type:"POST",
		url: "ajax/estadoComportamiento.php",              
		data: "id=" + id + " && est=" + est,
		beforeSend: function() {//antes de enviar
			$('#mloading').modal({ keyboard: false, backdrop:'static',});
		},
		success: function(paso)
		{	
			//alert(paso);
			if(paso==1)
			{
				
				ob.attr("rel",est);
				if(est==0)
				{
					ob.removeClass("success");
					ob.addClass("danger");
					ob.html("<b><i class='fa fa-window-close'></i> Inactivo</b>");
				}
				else
				{
					ob.removeClass("danger");
					ob.addClass("success");
					ob.html("<b><i class='fa fa-check'></i> Activo</b>");
				}
			}
		},
		complete: function() {
			$('#mloading').modal('hide');
		}
	});
});

</script>