<!--conecion a la base de datos -->
<?php
	require ("../class/safer.class.php");
	$obj = new Safer();
?>
<!--conecion a la base de datos -->
<!--tabla emergente de boton nuevo -->
<table id="usuarios" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Num_empleado</th>
      <th>correo</th>
      <th>contraseña</th>
      <th>sexo</th>
      <th>puesto</th>
      <th>departamento</th>
      <th>Rol</th>
      <th>Estado</th>
      <th>Opciones</th>
    </tr>
  </thead>


  <tbody>
    
  <?php
    if ($obj->conecta())
    {
        $datos = $obj->getUsuarios();
        while ($fila = sqlsrv_fetch_array($datos))
        {
            $id_usuario = $fila["id_usuario"];
            $nombre = $fila["nombre"];
            $apellidos = $fila["apellidos"];
            $num_empleado = $fila["num_empleado"];
            $email = $fila["email"];
            $contra = $fila["contrasena"];
            $sexo = $fila["sexo"];
            
            $id_puesto = $fila["id_puesto"];
            $puesto = $obj->getPuesto($id_puesto);
            
            $id_departamento = $fila["id_departamento"];
            $depa = $obj->getDepartamento($id_departamento);
            
            $id_rol = $fila["id_rol"];
            $rol = $obj->getRol($id_rol);
            
            $estado = $fila["estatus"];
            
                    
            echo "<tr>";
            echo "<td>$nombre</td>
              <td>$apellidos</td>
              <td>$num_empleado</td>
              <td>$email</td>
              <td>$contra</td>
              <td>$sexo</td>
              <td>$puesto</td>
              
              <td>$depa</td>
              <td>$rol</td>";
			//botosn estados de los usarios 
			if ($estado)
				echo $es= "<td class='edo mano success text-center' alt='$id_usuario' rel='$estado'><b><i class='fa fa-thumbs-o-up'></i> Activo</b></td>";	
			else
			 	echo $es= "<td class='edo mano danger text-center' alt='$id_usuario' rel='$estado'><b><i class='fa fa-thumbs-o-down'></i> Inactivo</b></td>";
			  
              
              echo "<td>";
              echo "<button class='editar btn btn-round btn-info' alt='$id_usuario'>Editar</button>";
              //echo "<button class='eliminar btn btn-round btn-danger' alt='$id_usuario'>Eliminar</button>";
              echo "</td>";
            echo "</tr>";
            
        }
    }

  ?>                        
  </tbody>
</table>
<!--tabla emergente de boton nuevo -->
<script>
//boton nuevo registro
$('#nuevo').on('click',function(){
	$('#formulario')[0].reset();//limpiar formulario de campos y valores 
	$('#contenido').find('input, textarea, button, select').removeAttr('disabled');//desbloquear elementos de usuarios 
	$('#titulo').text('Agregar Usuario:');
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
	$('#formulario')[0].reset();//reiniciar formulario
	$('#contenido').find('input, textarea, button, select').removeAttr('disabled');
	
	var url = 'ajax/editarUsuario.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id_usuario='+id,
		beforeSend: function() {//antes de enviar
			$('#mloading').modal({ keyboard: false, backdrop:'static',});
		},
		success: function(valores){
			//alert (valores);
			var datos = eval(valores);
			$('#reg').hide();
			$('#edi').show();
			
			$('#titulo').text('Edicion de Usuario:');
			$('#pro').val('2');
			$('#id_usuario').val(id);
			$('#correo_actual').val(datos[4]);
			$('#nombre').val(datos[1]);
			$('#apellidos').val(datos[2]);
			$('#numero').val(datos[3]);
			$('#correo').val(datos[4]);
			$('#correo_actual').val(datos[4]);
			genero = datos[6];
			
			if (genero == "M")//mujer
				document.querySelector('#gen2').checked = true;
			else
				document.querySelector('#gen1').checked = true;
			
			$('#departamento').val(datos[8]);
			$('#puesto').val(datos[7]);
			$('#rol').val(datos[9]);
			$('#password1').val(datos[5]);
			$('#password2').val(datos[5]);
			
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
		url: "ajax/estadoUsuario.php",              
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

//eliminar
$(".eliminar").click(function()
{
	var ob=$(this);
	var id = ob.attr("alt");
	$.ajax(
	{
		async:true, type:"POST",
		url: "ajax/eliminaUsuario.php",              
		data: "id=" + id + " && est=" + est,
		beforeSend: function() {//antes de enviar
			$('#mloading').modal({ keyboard: false, backdrop:'static',});
		},
		success: function(paso)
		{
			alert (paso);	
			/*if(paso==1)
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
			}*/
		},
		complete: function() {
			$('#mloading').modal('hide');
		}
	});
});

</script>