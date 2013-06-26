<?php 
	//script para ejecutar Ajax


	//insertar y actualizar tabla de usuarios
	sleep(3);

	$salidaJson = array("respuesta" => "error",
						"mensaje" => "Primera prueba jQuery ajax",
						"contenido" => "Ya podemos continuar con el siguiente capitulo");

	echo json_encode($salidaJson);
?>