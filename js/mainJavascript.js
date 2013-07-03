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
	       		$('#id_user').val('0');
	       }
	});

	//funcionalidad del boton que abre el formulario
	$('#goNuevoUser').on('click', function(){
		
		//Asignamos valor a la variable accion
		$('#accion').val('addUser');

		//Abrimos el formulario
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
				data:str + "&id=" + Math.random(),
				success: function(response){
					//Validamos mensaje de error
					if (response.respuesta == false) {
						alert(response.mensaje);
					}else{
						
						// si es exitosa la operación 
						$('#agregarUser').dialog('close');
						
						//alert(response.contenido);
						
						if ($('#sinDatos').length){
							$('#sinDatos').remove();
						}

						$('#listaUsuariosOK').append(response.contenido);	
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
	
	//Edición de registros
	$('body').on('click','#listaUsuariosOK a',function (e){
		e.preventDefault();
		//alert($(this).attr('href'));

		//Valor a la accion
		$('#accion').val('editUser');

		//Id Usuario
		$('#id_user').val($(this).attr('href'));

		//Abrimos el formulario
		$('#agregarUser').dialog('open');

		//Llenar el formulario con los datos del registro seleccionado  
		$('#usr_nombre').val($(this).parent().parent().children('td:eq(0)').text());
		$('#usr_puesto').val($(this).parent().parent().children('td:eq(1)').text());
		$('#usr_nick').val($(this).parent().parent().children('td:eq(2)').text());

		//Seleccionar el status
		$('#usr_status option[value='+ $(this).parent().parent().children('td:eq(3)').text() +']').attr('selected',true);

		console.log($('#usr_status option[value='+ $(this).parent().parent().children('td:eq(3)').text() +']').attr('selected',true));

	}); 
});