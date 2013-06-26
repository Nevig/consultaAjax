$(function(){
	$('#agregarUser').dialog({
		autoOpen: false,
		   modal: true,
		   width: 305,
		  height: 'auto',
	   resizible: false,
	       close: function(){
	       		$('#formUsers fieldset > span').removeClass('error').empty();
	       		$('#formUsers input[type="text"]').val('');
	       		$('#formUsers select > option').removeAttr('selected');
	       }
	});

	$('#goNuevoUser').on('click', function(){
		$('#agregarUser').dialog('open');
	});

	//validar Formulario
	$('#formUsers').validate({
		submitHandler: function(){
			var str = $('#formUsers').serialize();
			//alert(str);

			$.ajax({
				beforeSend:function(){
					$('#formUsers .ajaxLoader').show();
				},
				cache: false,
				type: "POST",
				dataType: "json",
				url:"includes/phpAjaxUsers.inc.php",
				data:str = "&accion=addUser&id=" + Math.random(),
				success: function(response){
					//Validamos mensaje de error
					if (response.respuesta == 'error') {
						alert(response.mensaje);
					}else{
						// si es exitosa la operación 
						$('#agregarUser').dialog('close');
						alert(response.contenido);
					}
					$('#formUsers .ajaxLoader').hide();		
				},
				error: function(){
					alert('ERROR GENERAL DEL SISTEMA, INTENTE MAS TARDE');
				}
			});
			return false;
		},
		errorPlacement: function(error, element){
			error.appendTo(element.prev("span").append());
		}
	});
});