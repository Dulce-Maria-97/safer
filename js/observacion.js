//cargar los registros al abrir la pagina
$(document).ready(function(e) {
	recarga();	
});
//solo recarga la tabla 
function recarga()
{
	$("#datos").html("<center><img src='img/b_loading.gif'><br><b>C A R G A N D O . . .</b></center>")
	$("#datos").load('ajax/getObservaciones.php', {id_usuario: $("#id_usuario").val()},function(response,status,xhr){
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



$("#registrar").on("shown.bs.modal", function () { 
    $("#area").focus();
});

function validacampos()
{
	$pen=1;
	//if($("#folio").val()==0){
		//$("#folio").addClass("alert-danger"); $pen=0; }
	
	if($("#fecha").val()==0){
		$("#fecha").addClass("alert-danger");$pen=0; }
	
	if($("#numero").val()==0){
	$("#numero").addClass("alert-danger"); $pen=0; }
	
	if($("#area").val()==0){
	$("#area").addClass("alert-danger"); $pen=0; }
	
	if($("#puesto").val()==0){
	$("#puesto").addClass("alert-danger"); $pen=0; }
	
	if($("#comportamiento").val()==0){
	$("#comportamiento").addClass("alert-danger"); $pen=0; }
	
	if($("#aspectos").val()==0){
	$("#aspectos").addClass("alert-danger"); $pen=0; }
	
	if($("#departamento").val()==0){
	$("#departamento").addClass("alert-danger"); $pen=0; }
	
	if($("#tipo").val()==0){
	$("#tipo").addClass("alert-danger"); $pen=0; }
	
	if($("#criticidad").val()==0){
	$("#criticidad").addClass("alert-danger"); $pen=0; }
	
	if($("#descripcion").val()==0){
	$("#descripcion").addClass("alert-danger"); $pen=0; }
	
	if($("#acciones").val()==0){
	$("#acciones").addClass("alert-danger"); $pen=0; }
	
	return $pen;
}

//metodo de guardo 
$("#reg").click(function(e){//registrar
	limpia_campos();
	
	if(validacampos()==0)
	{
		alerta("bg-danger", ' <b> Favor de llenar todo los campos  . . .<b>', "¡ALERTA!");
	}
	else
	{	
		var url ='ajax/agrega_observacion.php';
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formulario').serialize(),
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
	
	if($("#fecha").hasClass("alert-danger"))
		$("#fecha").removeClass("alert-danger");
	
	if($("#numero").hasClass("alert-danger"))
		$("#numero").removeClass("alert-danger");
	
	if($("#area").hasClass("alert-danger"))
		$("#area").removeClass("alert-danger");
	
	if($("#puesto").hasClass("alert-danger"))
		$("#puesto").removeClass("alert-danger");
	
	if($("#comportamiento").hasClass("alert-danger"))
		$("#comportamiento").removeClass("alert-danger");
	
	if($("#aspectos").hasClass("alert-danger"))
		$("#aspectos").removeClass("alert-danger");
	
	if($("#departamento").hasClass("alert-danger"))
		$("#departamento").removeClass("alert-danger");
		
	if($("#tipo").hasClass("alert-danger"))
		$("#tipo").removeClass("alert-danger");
		
	if($("#criticidad").hasClass("alert-danger"))
		$("#criticidad").removeClass("alert-danger");		
	
	if($("#descripcion").hasClass("alert-danger"))
		$("#descripcion").removeClass("alert-danger");
	
	if($("#acciones").hasClass("alert-danger"))
		$("#acciones").removeClass("alert-danger");
}