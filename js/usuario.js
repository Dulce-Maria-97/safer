//cargar los registros al abrir la pagina
$(document).ready(function(e) {
	recarga();	
});
//solo recarga la tabla 
function recarga()
{
	$("#datos").html("<center><img src='img/b_loading.gif'><br><b>C A R G A N D O . . .</b></center>")
	$("#datos").load('ajax/getUsuarios.php', { },function(response,status,xhr){
		if(status == 'success')
		{			
			var table = $('#usuarios').DataTable({
				language: {//traducir plugin datatable
					"decimal": "",
					"emptyTable": "No hay información",
					"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
					"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
					"infoFiltered": "(Filtrado de _MAX_ total entradas)",
					"infoPostFix": "",
					"thousands": ",",
					"lengthMenu": "Mostrar _MENU_ Entradas",
					"loadingRecords": "Cargando...",
					"processing": "Procesando...",
					"search": "Buscar:",
					"zeroRecords": "Sin resultados encontrados",
					"paginate": {
						"first": "Primero",
						"last": "Ultimo",
						"next": "Siguiente",
						"previous": "Anterior"
					}
				}
			});

		}
	});
}
//solo recarga la tabla 
//metodo de guardo 
$("#reg").click(function(e){//registrar
	var nom=$("#nombre").val().length;
	var ape=$("#apellidos").val().length;
	var num=$("#numero").val().length;
	var cor=$("#correo").val().length;
	var genero = $('input:radio[name=genero]:checked').val();
	var dep=$("#departamento").val();
	var pues=$("#puesto").val();	
	var rol=$("#rol").val();		
	var con1=$("#password1").val();
	var con2=$("#password2").val();
	
	limpia_campos();
	var llena = 1;
	
	if(nom==0){	
		$("#nombre").addClass("alert-danger");
		llena = 0;	
	}
	else if(ape==0){	
		$("#apellidos").addClass("alert-danger");
		llena = 0;	
	}
	else if(num==0){	
		$("#numero").addClass("alert-danger");
		llena = 0;	
	}
	else if(cor==0){	
		$("#correo").addClass("alert-danger");
		llena = 0;	
	}
	else if(genero===undefined){
		
		$("#gender").addClass("alert-danger");	
		llena =0;
	}
	else if(dep==0){	
		$("#departamento").addClass("alert-danger");
		llena = 0;	
	}	
	else if(pues==0){	
		$("#puesto").addClass("alert-danger");
		llena = 0;	
	}
	else if(rol==0){	
		$("#rol").addClass("alert-danger");
		llena = 0;	
	}	
	
	else if(con1==0){	
		$("#password1").addClass("alert-danger");
		llena = 0;	
	}
	
	else if(con2==0){	
		$("#password2").addClass("alert-danger");
		llena = 0;	
	}
	
	if (llena==0)
		alerta("bg-danger", ' <b> Favor de llenar todo los campos  . . .<b>', "¡ALERTA!");
	
	
	
	if (llena == 1)//valido logica
	{
		if($("#password1").val().length <8 || $("#password2").val().length <8)
			alerta("bg-danger", ' <b> La contraseña debe de ser de 8 dígitos . . .<b>', "¡ALERTA!");
		else if(con1 == con2)//guardo
		{
			var genero = $('input:radio[name=genero]:checked').val();
			var url ='ajax/agrega_usuario.php';
			$.ajax({
				type:'POST',
				url:url,
				data:$('#formulario').serialize() + "&&genero=" + genero,
				beforeSend: function() {//antes de enviar
					$('#contenido').find('input, textarea, button, select').attr('disabled','disabled');
					$('#mloading').modal({ keyboard: false, backdrop:'static',});
				},
				success: function(registro){
					/*alert(registro);*/
					
					if (registro == 777)
					{
						alerta("bg-warning", ' <b> El correo existe . . .<b>', "¡ALERTA!");
						
						$('#contenido').find('input, textarea, button, select').removeAttr('disabled');//desbloquear elementos de usuarios 
						$("#correo").focus();
						$("#correo").addClass("alert-danger");
					}
					if (registro ==1)
					{	
						alerta("bg-success", ' <b> guardado . . .<b>', "¡ALERTA!");
						setTimeout ("$('#registrar').modal('hide');", 3000);
						setTimeout ("recarga();", 1000);
						
					}
				},
				complete: function() {
					$('#mloading').modal('hide');
				}
			});			
		}
		else{
			alerta("bg-danger", ' <b> contraseñas no coinciden . . .<b>', "¡ALERTA!");
		}
		
	}
});

//metodo de guardo 

//metodo de edicion 
$("#edi").click(function(e){//actualizar
	var nom=$("#nombre").val().length;
	var ape=$("#apellidos").val().length;
	var num=$("#numero").val().length;
	var cor=$("#correo").val().length;
	var genero = $('input:radio[name=genero]:checked').val();
	var dep=$("#departamento").val();
	var pues=$("#puesto").val();	
	var rol=$("#rol").val();		
	var con1=$("#password1").val();
	var con2=$("#password2").val();
	
	limpia_campos();
	var llena = 1;
	
	if(nom==0){	
		$("#nombre").addClass("alert-danger");
		llena = 0;	
	}
	else if(ape==0){	
		$("#apellidos").addClass("alert-danger");
		llena = 0;	
	}
	else if(num==0){	
		$("#numero").addClass("alert-danger");
		llena = 0;	
	}
	else if(cor==0){	
		$("#correo").addClass("alert-danger");
		llena = 0;	
	}
	else if(genero===undefined){
		
		$("#gender").addClass("alert-danger");	
		llena =0;
	}
	else if(dep==0){
		$("#departamento").addClass("alert-danger");
		llena = 0;	
	}	
	else if(pues==0){	
		$("#puesto").addClass("alert-danger");
		llena = 0;	
	}
	else if(rol==0){	
		$("#rol").addClass("alert-danger");
		llena = 0;	
	}	
	
	else if(con1==0){	
		$("#password1").addClass("alert-danger");
		llena = 0;	
	}
	
	else if(con2==0){	
		$("#password2").addClass("alert-danger");
		llena = 0;	
	}
	
	if (llena==0)
		alerta("bg-danger", ' <b> Favor de llenar todo los campos  . . .<b>', "¡ALERTA!");
	
	
	
	if (llena == 1)//valido logica
	{
		if($("#password1").val().length <8 || $("#password2").val().length <8)
			alerta("bg-danger", ' <b> La contraseña debe de ser de 8 dígitos . . .<b>', "¡ALERTA!");
		else if(con1 == con2)//guardo
		{
			var genero = $('input:radio[name=genero]:checked').val();
			var url ='ajax/agrega_usuario.php';
			$.ajax({
				type:'POST',
				url:url,
				data:$('#formulario').serialize() + "&&genero=" + genero,
				beforeSend: function() {//antes de enviar
					//$('#contenido').find('input, textarea, button, select').attr('disabled','disabled');
					$('#mloading').modal({ keyboard: false, backdrop:'static',});
				},
				success: function(registro){
					console.log(registro);
					if (registro ==1)
					{	
						alerta("bg-primary", ' <b> actualizado . . .<b>', "¡ALERTA!");
						setTimeout ("$('#registrar').modal('hide');", 3000);
						setTimeout ("recarga();", 1000);
						
					}
				},
				complete: function() {
					$('#mloading').modal('hide');
				}
			});			
		}
		else{
			alerta("bg-danger", ' <b> contraseñas no coinciden . . .<b>', "¡ALERTA!");
		}
		
	}
});
//metodo de edicion


//proceso de limpiar los campos		
function limpia_campos(){
	if ($("#nombre").hasClass("alert-danger"))
		$("#nombre").removeClass("alert-danger");
	if ($("#apellidos").hasClass("alert-danger"))
		$("#apellidos").removeClass("alert-danger");
	if ($("#numero").hasClass("alert-danger"))
		$("#numero").removeClass("alert-danger");
	if ($("#correo").hasClass("alert-danger"))
		$("#correo").removeClass("alert-danger");	
	if ($("#gender").hasClass("alert-danger"))
		$("#gender").removeClass("alert-danger");		
	if ($("#departamento").hasClass("alert-danger"))
		$("#departamento").removeClass("alert-danger");
	if ($("#puesto").hasClass("alert-danger"))
		$("#puesto").removeClass("alert-danger");
	if ($("#rol").hasClass("alert-danger"))
		$("#rol").removeClass("alert-danger");
	if ($("#password1").hasClass("alert-danger"))
		$("#password1").removeClass("alert-danger");
	if ($("#password2").hasClass("alert-danger"))
		$("#password2").removeClass("alert-danger");
}		
//proceso de limpiar los campos	