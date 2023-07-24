//cargar los registros al abrir la pagina
$(document).ready(function(e) {
	recarga();	
});
//solo recarga la tabla 
function recarga()
{
	$("#datos").html("<center><img src='img/b_loading.gif'><br><b>C A R G A N D O . . .</b></center>")
	$("#datos").load('ajax/getAutorizacionesObservaciones.php', {id_usuario: $("#id_usuario").val()},function(response,status,xhr){
		if(status == 'success')
		{
			//aprica el pruyin de data tabla
			var table = $('#observaciones').DataTable({
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
$("#autorizar").click(function(e){
	var id = $("#folio").val();

	var url ='ajax/autorizar.php';
	$.ajax({
		type:'POST',
		url:url,
		data:"id="+id+"&&est="+4,
		beforeSend: function() {//antes de enviar
			$('#mloading').modal({ keyboard: false, backdrop:'static',});
		},
		success: function(registro){
			//alert(registro);
			
			if (registro ==1)
			{	
				alerta("bg-success", ' <b> Autorizada . . .<b>', "¡ALERTA!");
				setTimeout ("$('#registrar').modal('hide');", 3000);
				setTimeout ("recarga();", 1000);
				
			}
		},
		complete: function() {
			$('#mloading').modal('hide');
		}
	});		
});

$("#rechazar").click(function(e){
	var id = $("#folio").val();

	var url ='ajax/estadoObservacion.php';
	$.ajax({
		type:'POST',
		url:url,
		data:"id="+id+"&&est="+0,
		beforeSend: function() {//antes de enviar
			$('#mloading').modal({ keyboard: false, backdrop:'static',});
		},
		success: function(registro){
			//alert(registro);
			if (registro ==1)
			{	
				alerta("bg-danger", ' <b> Rechazada . . .<b>', "¡ALERTA!");
				setTimeout ("$('#registrar').modal('hide');", 3000);
				setTimeout ("recarga();", 1000);
				
			}
		},
		complete: function() {
			$('#mloading').modal('hide');
		}
	});		
});