<?php 

	//Omitir errores 
	ini_set("display_errors", false);


	//incluimos nuestro archivo de funciones y conexion a la base de datos
	include('includes/mainFunctions.inc.php');

	if ($errorDBConexion == false) {
		//Manda a llamar  la función para mostrar la lista de usuarios 
		$consultaUsuarios = consultaUsers($mysqli);
	}else{
		//Regresa error en la base de datos
		$consultaUsuarios = '
			<tr id="sinDatos">
				<td colspan = "5" class="centerTXT">ERROR AL CONECTAR A LA BASE DE DATOS</td>
			</tr>
		';
	}
 ?>
<!DOCTYPE html>
<html lang="es">
	<header>
		<title>JQuery Ajax para consulta PHP</title>
		<meta charset="utf-8"/>
		
		<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> 
		
	</header>
	<body>
		<div  id="agregarUser" title="Agregar Usuario">
			<form action="" method="post" id="formUsers" name="formUsers">
				<fieldset id="ocultos">
					<input type="hidden" id="accion" class="required" name="accion" />
					<input type="hidden" id="id_user" class="required" name="id_user" value="0"/>  
				</fieldset>
				<fieldset id="datoUser">
					<p>Nombre</p>
					<span></span>
					<input type="text" id="usr_nombre" name="usr_nombre" placeholder="Nombre Completo" class="required span3" />
					<p>Puesto</p>
					<span></span>
					<input type="text" id="usr_puesto" name="usr_puesto" placeholder="puesto que desempeño" class="required span3" />
					<p>Nickname</p>
					<span></span>
					<input type="text" id="usr_nick" name="usr_nick" placeholder="nickname" class="required span3" />
					<p>status</p>
					<span></span>
					<select name="usr_status" id="usr_status" class="required span3">
						<option value="">Seleccione una Opción..</option>
						<option value="Activo">Activo</option>
						<option value="Suspendido">Suspendido</option>
					</select>
				</fieldset>
				<fieldset id="btnAgregar" style="text-align:center;">
					<input type="submit" id="continuar" value="Continuar">
				</fieldset>
				<fieldset id="ajaxLoader" class="ajaxLoader hide">
					<img src="images/default-loader.gif" alt=""></img>
					<span>Espere un momento...</span>
				</fieldset> 	
			</form>
		</div>

		<div id="dialog-borrar" title="Eliminar Registro" class="hide">
			<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Este registro se borrara de forma permanente. ¿Esta seguro?</p>
		</div>
		<div id="wraper">
			<section id="content">
				<div id="btnAddUser" class="center addUser">
					<button id="goNuevoUser" class="btn btn-inverse btn-small"><i class="icon-plus"></i>Agregar Usuario</button>	
				</div>
				<div id="listaOrganizadores" class="anchoTablaLargo550 centrarDiv">
					<table id="listadoUsers" class="table table-striped table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Puesto</th>
								<th>Nickname</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="listaUsuariosOK"> 
							<?php echo $consultaUsuarios ?>
						</tbody>
					</table>	
				</div>
			</section>
		</div>
		<footer>
			
		</footer>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>

		<script src="js/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="js/jquery-validation/localization/messages_es.js"></script>
		<script src="js/mainJavascript.js"></script>
	</body>
</html>