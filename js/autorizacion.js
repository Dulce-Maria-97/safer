//cargar los registros al abrir la pagina
$(document).ready(function(e) {
	recarga();	
});
//solo recarga la tabla 
function recarga()
{
	$("#datos").html("<center><img src='img/b_loading.gif'><br><b>C A R G A N D O . . .</b></center>")
	$("#datos").load('ajax/getAutorizacion.php', { },function(response,status,xhr){
		if(status == 'success')
		{
			//aprica el pruyin de data tabla
			var table = $('#oservacion').DataTable({
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



/*$("#registrar").on("shown.bs.modal", function () { 
    $("#area").focus();
});

//metodo de guardo 
$("#reg").click(function(e){//registrar
var ar=$("#area").val().length;

limpia_campos();
	var llena = 1;
	
	if(ar==0){	
		$("#area").addClass("alert-danger");
		llena = 0;	
	}
	if (llena==0)
		alerta("bg-danger", ' <b> Favor de llenar todo los campos  . . .<b>', "¡ALERTA!");
	
	if (llena == 1)//valido logica
	{

			<!--ajax inicio-->
			var url ='ajax/agrega_area.php';
			$.ajax({
				type:'POST',
				url:url,
				data:$('#formulario').serialize(),
				beforeSend: function() {//antes de enviar
					$('#contenido').find('input, textarea, button, select').attr('disabled','disabled');
					$('#mloading').modal({ keyboard: false, backdrop:'static',});
				},
				success: function(registro){
					//alert(registro);
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
			<!--fin ajax-->		
		
	}
});

//metodo de edicion 
$("#edi").click(function(e){//actualizar
	var ar=$("#area").val().length;
		
	limpia_campos();
	var llena = 1;
	
	if(ar==0){	
		$("#area").addClass("alert-danger");
		llena = 0;	
	}
	
	if (llena==0)
		alerta("bg-danger", ' <b> Favor de llenar todo los campos  . . .<b>', "¡ALERTA!");
	
	
	
	if (llena == 1)//valido logica
	{
		
			var url ='ajax/agrega_area.php';
			$.ajax({
				type:'POST',
				url:url,
				data:$('#formulario').serialize(),
				beforeSend: function() {//antes de enviar
					//$('#contenido').find('input, textarea, button, select').attr('disabled','disabled');
					$('#mloading').modal({ keyboard: false, backdrop:'static',});
				},
				success: function(registro){
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
});*/


//metodo de edicion

	//proceso de limpiar los campos		
	function limpia_campos(){
	if ($("#area").hasClass("alert-danger"))
	$("#area").removeClass("alert-danger");
	}