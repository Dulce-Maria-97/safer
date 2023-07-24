//cargar los registros al abrir la pagina
$(document).ready(function(e) {
	recarga();	
});
//solo recarga la tabla 
function recarga()
{
	$("#datos").html("<center><img src='img/b_loading.gif'><br><b>C A R G A N D O . . .</b></center>")
	$("#datos").load('ajax/getObservacionesRealizadas.php', {id_usuario: $("#id_usuario").val()},function(response,status,xhr){
		if(status == 'success')
		{
			//aprica el pruyin de data tabla
			var table = $('#observaciones').DataTable({
				dom: 'Bfrtip',
		        buttons: [
		            {
		                extend: 'excelHtml5',
		                title: 'Observaciones realizadas'
		            }
		        ],
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



$("#registrar").on("shown.bs.modal", function () { 
    $("#area").focus();
});

function validacampos()
{
	$pen=1;
	//if($("#folio").val()==0){
		//$("#folio").addClass("alert-danger"); $pen=0; }
	
	if($("#p_accion").val()==0){
		$("#p_accion").addClass("alert-danger");$pen=0; }
	
	if($("#t_solucion").val()==0){
	$("#t_solucion").addClass("alert-danger"); $pen=0; }
	
	if($("#consecuencia").val()==0){
	$("#consecuencia").addClass("alert-danger"); $pen=0; }
	
	if($("#presupuesto").val()==0){
	$("#presupuesto").addClass("alert-danger"); $pen=0; }
	return $pen;
}

function validacampos_plan()
{
	$pen=1;
	if($("#definir_p").val()==0){
		$("#definir_p").addClass("alert-danger");$pen=0; }
	if($("#fecha_compromiso_p").val()==0){
		$("#fecha_compromiso_p").addClass("alert-danger"); $pen=0; }
	return $pen;
}

//metodo de guardo 
$("#archivar").click(function(e){
	$("#archivado").modal();
			
});


//pedir autorizacion
$("#pedir_autorizacion").click(function(e)
{
	$("#autorizacion").modal();
});

//plan accion
$("#pedir_plan").click(function(e)
{
	$("#plan_accion").modal();
});

$("#archiva_final").click(function(e)
{
	//limpiar
	$("#com_final").removeClass("alert-danger");
	$("#archivoImage").removeClass("alert-danger");
	
	var comentario = $("#com_final").val().length;
	var foto = $("#archivoImage").val().length;
	
	
	if (comentario ==0){
		$("#com_final").addClass("alert-danger");
		alerta("bg-danger", ' <b> Agregar comentario . . .<b>', "¡ALERTA!");
	}
	else if (foto ==0){
		$("#archivoImage").addClass("alert-danger");
		alerta("bg-danger", ' <b> Agregar foto . . .<b>', "¡ALERTA!");
	}
	else
	{//procesar
		var id = $("#folio").val();
		var comentario = $("#com_final").val();
		var inputFileImage = document.getElementById("archivoImage");
		var file = inputFileImage.files[0];
		
		var data = new FormData();
		
		data.append('archivo',file);
		data.append('id',id);
		data.append('comentario',comentario);
		
		var url = "ajax/archivar.php";
		$.ajax({
			url:url,
			type:'POST',
			contentType:false,
			data:data,
			processData:false,
			cache:false,
			beforeSend: function() {//antes de enviar
				$('#mloading').modal({ keyboard: false, backdrop:'static',});
			},
			success: function(data)
			{
				//alert(data);
				
				if (data ==1)
				{	
					alerta("bg-success", ' <b> Archivada . . .<b>', "¡ALERTA!");
					setTimeout ("$('#registrar').modal('hide');", 3000);
					setTimeout ("recarga();", 1000);	
				}
			},
			complete: function() {
				$('#mloading').modal('hide');
			}	
		});		
	}
});

//metodo de guardo 
$("#solicitar").click(function(e){//registrar
	limpia_campos();
	if(validacampos()==0)
	{
		alerta("bg-danger", ' <b> Favor de llenar todo los campos  . . .<b>', "¡ALERTA!");
	}
	else
	{	
		var url ='ajax/solicita_autorizacion.php';
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formulario_auto').serialize() + "&&folio=" +$("#folio").val(),
			beforeSend: function() {//antes de enviar
				//$('#contenido').find('input, textarea, button, select').attr('disabled','disabled');
				$('#mloading').modal({ keyboard: false, backdrop:'static',});
			},
			success: function(registro){
				//alert(registro);
				console.log(registro);
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
});

$("#solicitar_plan").click(function(e){//registrar
	limpia_campos_plan();
	if(validacampos_plan()==0)
	{
		alerta("bg-danger", ' <b> Favor de llenar todo los campos  . . .<b>', "¡ALERTA!");
	}
	else
	{
		
		var url ='ajax/plan_accion.php';
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formulario_accion').serialize() + "&&folio=" +$("#folio").val(),
			beforeSend: function() {//antes de enviar
				//$('#contenido').find('input, textarea, button, select').attr('disabled','disabled');
				$('#mloading').modal({ keyboard: false, backdrop:'static',});
			},
			success: function(registro){
				//console.log(registro);
				if (registro ==1)
				{	
					alerta("bg-primary", ' <b> guardado plan de accion . . .<b>', "¡ALERTA!");
					setTimeout ("$('#registrar').modal('hide');", 3000);
					setTimeout ("recarga();", 1000);
				}
			},
			complete: function() {
				$('#mloading').modal('hide');
			}
		});	
		
	}
});

//metodo de edicion 
$("#edi").click(function(e){//actualizar
	var ar=$("#comportamiento").val().length;
		
	limpia_campos();
	var llena = 1;
	
	if(ar==0){	
		$("#comportamiento").addClass("alert-danger");
		llena = 0;	
	}
	
	if (llena==0)
		alerta("bg-danger", ' <b> Favor de llenar todo los campos  . . .<b>', "¡ALERTA!");
	
	if (llena == 1)//valido logica
	{
		
			var url ='ajax/agrega_comportamiento.php';
			$.ajax({
				type:'POST',
				url:url,
				data:$('#formulario').serialize(),
				beforeSend: function() {//antes de enviar
					$('#contenido').find('input, textarea, button, select').attr('disabled','disabled');
					$('#mloading').modal({ keyboard: false, backdrop:'static',});
				},
				success: function(registro){
					//alert (registro);
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
});
//metodo de edicion

//proceso de limpiar los campos		
function limpia_campos(){	
	//if($("#folio").hasClass("alert-danger"))
		//$("#folio").removeClass("alert-danger");
	
	if($("#p_accion").hasClass("alert-danger"))
		$("#p_accion").removeClass("alert-danger");
	
	if($("#t_solucion").hasClass("alert-danger"))
		$("#t_solucion").removeClass("alert-danger");
	
	if($("#consecuencia").hasClass("alert-danger"))
		$("#consecuencia").removeClass("alert-danger");
	
	if($("#presupuesto").hasClass("alert-danger"))
		$("#presupuesto").removeClass("alert-danger");
	
	if($("#comportamiento").hasClass("alert-danger"))
		$("#comportamiento").removeClass("alert-danger");
}

function limpia_campos_plan(){	
	
	if($("#definir").hasClass("alert-danger"))
		$("#definir").removeClass("alert-danger");
	
	if($("#fecha_compromiso").hasClass("alert-danger"))
		$("#fecha_compromiso").removeClass("alert-danger");
}