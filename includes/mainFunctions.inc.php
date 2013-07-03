<?php 
	//Definir las constantes de conexión a la base de datos
	define("server", "localhost");
	define("user", "summax");
	define("pass", "summax");
	define("mainDataBase", "tutosWeb");

	//Variable que indica el status de la conexion a la base de datos
	$errorDBconexion = false;

	//Función para extraer el listado de usuarios 
	function consultaUsers($linkDB){

		$statusTipo = array("Activo" => "btn-success",
							"Suspendido" => "btn-warning");

		$salida = '';

		$consulta = $linkDB -> query("SELECT id_user, usr_nombre, usr_puesto, usr_nick, usr_status
									 FROM tbl_usuarios ORDER BY usr_nombre ASC");

		//Verificar el resultado de la consulta 
		if($consulta -> num_rows != 0){

			//Convertimos la información obtenida de la consulta
			while($listadoOK = $consulta -> fetch_assoc())
			{
				$salida .= '
					<tr>
						<td>'.$listadoOK['usr_nombre'].'</td>
						<td>'.$listadoOK['usr_puesto'].'</td>
						<td>'.$listadoOK['usr_nick'].'</td>
						<td class="centerTXT"><span class="btn btn-mini '.$statusTipo[$listadoOK['usr_status']].'">'.$listadoOK['usr_status'].'</span></td>
						<td class="centerTXT"><a class="btn btn-mini" href="'.$listadoOK['id_user'].'">Editar</a></td>
					</tr>
				';
			} 
		}else{
			$salida = '
				<tr id = "sinDatos">
					<td colspan="5" class="centerTXT">NO HAY REGISTROS EN LA BASE DE DATOS</td>
				</tr>
			';
		}
		return $salida;
	}

	if(defined('server') && defined('user') && defined('pass') && defined('mainDataBase'))
	{

		//Conexión con la base de datos
		$mysqli = new mysqli(server, user, pass, mainDataBase);

		//Verificamos si hay error al conectar
		if(mysqli_connect_error()){
			$errorDBconexion = true;
		} 

		//Evitando problemas con acentos
		$mysqli -> query("SET NAMES 'utf8'");
	}


?>