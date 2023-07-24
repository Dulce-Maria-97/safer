<!--conecion a la base de datos -->
<?php
	require ("../class/safer.class.php");
	$obj = new Safer();
?>
<!--conecion a la base de datos -->

<table id="pla_ac" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Folio</th>
                          <th>Folio observacion</th>
                          <th>Definir plan de acción</th>
                          <th>Fecha compromiso</th>
                          <th>Estado</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>


                      <tbody>
                        
                      <?php
						if ($obj->conecta())
						{
							$datos = $obj->getPlan_accion();
							while ($fila = sqlsrv_fetch_array($datos))
							{
								$id_plan_accion = $fila["id_plan_accion"];
								$id_observacion = $fila["id_observacion"];	
								$accion =$fila["accion"];
								$fecha_con = $fila["fecha_con"];	
								$estado = $fila["estatus"];
								
										
								echo "<tr>";
								echo "<td>$plan_de_accion</td>";
								  //botosn estados de los usarios 
								if ($estado)
									echo $es= "<td class='edo mano success text-center' alt='$id_autorizacion' rel='$estado'><b><i class='fa fa-thumbs-o-up'></i> Activo</b></td>";	
								else
									echo $es= "<td class='edo mano danger text-center' alt='$id_autorizacion' rel='$estado'><b><i class='fa fa-thumbs-o-down'></i> Inactivo</b></td>";
				
								  echo "<td>";
								  echo "<button class='editar btn btn-round btn-info' alt='$id_autorizacion' rel='$plan_de_accion'>Editar</button>";
								  //echo "<button class='btn btn-round btn-danger'>Eliminar</button>";
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
	$('#titulo').text('Plan de accion:');
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
	$('#id_autorizacion').val(id);
	$('#area').val(campo);

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
		url: "ajax/estadoArea.php",              
		data: "id=" + id + " && est=" + est,
		beforeSend: function() {//antes de enviar
			$('#mloading').modal({ keyboard: false, backdrop:'static',});
		},
		success: function(paso)
		{	
			if(paso==1)
			{
				
				ob.attr("rel",est);
				if(est==0)
				{
					ob.removeClass("success");
					ob.addClass("danger");
					ob.html("<b><i class='fa fa-thumbs-o-down'></i> Inactivo</b>");
				}
				else
				{
					ob.removeClass("danger");
					ob.addClass("success");
					ob.html("<b><i class='fa fa-thumbs-o-up'></i> Activo</b>");
				}
			}
		},
		complete: function() {
			$('#mloading').modal('hide');
		}
	});
});

</script>