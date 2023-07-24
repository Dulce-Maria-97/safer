$( "#i_ses" ).click(function() {
	var t1 = $("#usuario").val().length;
	var t2 = $("#contra").val().length;
	
	if (t1==0 || t2==0){
		alerta("bg-danger", ' <b> Favor de llenar usuario y contraseña . . .<b>', "¡ALERTA!");
		$("#usuario").addClass("alert-danger");
		$("#contra").addClass("alert-danger");
	}
	else
	{
		var jusu = $("#usuario").val();
	    var jpas = $("#contra").val();
	
		$.ajax({
				//parametros
				async: true,
				type: "POST",
				url: "ajax/valExiste.php",
				data: "us=" + jusu + "&& pw=" + jpas,
				//antes del envio
				beforeSend: function() {
					$('#mloading').modal({
					keyboard: false,
					backdrop: 'static'
					});
				},
				//si se ejecuta
				success: function(resp) {
					//alert(resp);
						
					if (resp == 1) {//usuario valido
						location.href = "inicio.php";
					} else if (resp == 2) {
						alerta("bg-warning", ' <b> Usuario o contraseña incorrecto . . .<b>', "¡ALERTA!");
						$("#usuario").focus();
					} else {
						alerta("bg-danger", ' <b> Error de conexión . . .<b>', "¡ALERTA!");
					}
				},
				//ajax complete
				complete: function(){
					$('#mloading').modal('hide');
				}
			});//fin ajax
	}	
});

