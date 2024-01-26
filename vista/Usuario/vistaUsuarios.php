<?php
ob_start();
?>
<?php 
	include '../../controlador/configBd.php';	
	include '../../controlador/ControlEntidad.php';
	include '../../controlador/ControlConexionPdo.php';
	include '../../modelo/Entidad.php';
	include 'eliminar.php';
	include 'guardar.php';

  session_start();
  if($_SESSION['email']==null)header('Location: http://localhost/webSiteEchez/login.php');
  $permisoParaEntrar=false;
	$listaRolesDelUsuario = $_SESSION['listaRolesDelUsuario'];
	//var_dump($listaRolesDelUsuario);
	for($i=0;$i<count($listaRolesDelUsuario);$i++){
		if($listaRolesDelUsuario[$i]->__get('name')=="Admin-Global"){
			$permisoParaEntrar = true;		
		}
		
	}
	if(!$permisoParaEntrar)header('Location: http://localhost/webSiteEchez/vista/vistaHome.php');
?>
<?php
		
	$arregloRolesConsulta = [];
	$objControlUsuario = new ControlEntidad('usuario');
	$arregloUsuarios = $objControlUsuario->listar();

	$objControlRol = new ControlEntidad('rol');
	$arregloRoles = $objControlRol->listar();
	//var_dump($arregloRoles);
    $boton = $_POST['bt'] ?? '';//toma del arreglo post el value del bt
	$TableName = 'usuario';
	$Id = $_POST['txtId'] ?? '';	
	$Name = $_POST['txtName'] ?? '';
	$Email = $_POST['txtEmail'] ?? '';
	$Password = $_POST['txtPassword'] ?? '';
	$listbox1 = $_POST['listbox1'] ?? '';
	$listbox1Edit = $_POST['listbox1Edit'] ?? '';
	//var_dump($listbox1);
	switch ($boton) {
		case 'Guardar':
			//session_start();
            //$_SESSION['msj'] = "se registró el usuario de forma correcta";

			// Hashea la contraseña con Bcrypt
            $hash = password_hash($Password, PASSWORD_BCRYPT);
			$datosUsuario = ['Name'=>$Name,'Email'=>$Email,'Password'=>$hash];
			$objUsuario = new Entidad($datosUsuario);
			$objControlUsuario = new ControlEntidad('usuario');
			$objControlUsuario->guardar($objUsuario);
			if (!empty($listbox1)){
				for($i = 0; $i < count($listbox1); $i++){
					$IdRol = (int) explode(";", $listbox1[$i][0]);		

					//Se consulta el Id del usuario para poder agregarlo en rol_usuario					                  
					$objUsuario = $objControlUsuario->buscarPorId('email',$Email);
					$Id = (int) $objUsuario->__get('Id');

					$datosRolUsuario = ['FkIdUsuario'=>$Id,'FkIdRol'=>$IdRol];
					$objRolUsuario = new Entidad($datosRolUsuario);

					$objControlRolUsuario = new ControlEntidad('rol_usuario');
					$objControlRolUsuario->guardar($objRolUsuario);
				}
			}
			//var_dump($Id,$IdRol,$Email);		
			header('Location: vistaUsuarios.php');			
			break;
		case 'Consultar':
			$datosUsuario = ['Email'=>$Email];
			$objUsuario = new Entidad($datosUsuario);
			$objControlUsuario = new ControlEntidad('usuario');
			$objUsuario = $objControlUsuario->buscarPorId('Email',$Email);

			// Validar si $objUsuario es nulo antes de acceder a sus propiedades
			if ($objUsuario !== null) {
				$Password = $objUsuario->__get('Password');
				$Name = $objUsuario->__get('Name');
				$Id = $objUsuario->__get('Id');
				$objControlRolUsuario = new ControlEntidad('rol_usuario');
				$sql = "SELECT rol.Id as Id, rol.Name as Name
						FROM rol_usuario INNER JOIN rol ON rol_usuario.FkIdRol = rol.Id
						WHERE FkIdUsuario = ?";
				$parametros = [$Id];
				$arregloRolesConsulta = $objControlRolUsuario->consultar($sql, $parametros);
			} else {
				// Manejar el caso en que $objUsuario es nulo
				echo "El usuario no se encontró.";
			}
			break;		

		case 'Modificar': 
			// Se debería llamar a un procedimiento almacenado con control de transacciones
			//para modificar en las dos tablas
			//1. modifica en tabla principal

			// Hashea la contraseña con Bcrypt
            //$hash = password_hash($Password, PASSWORD_BCRYPT);    
			$datosUsuario=['name'=> $Name, 'email' => $Email];
			$objUsuario=new Entidad($datosUsuario);
			$objControlUsuario = new ControlEntidad('usuario');
			$objControlUsuario->modificar('email', $Email, $objUsuario);
			
			//2. borrar todos los registros asociados de la tabla principal en la tabla intermedia
			$objUsuario = $objControlUsuario->buscarPorId('Email',$Email);
			$Id = $objUsuario->__get('Id');
			$objControlRolUsuario = new ControlEntidad('rol_usuario');
			$objControlRolUsuario->borrar('fkidusuario',$Id);

			//3. tomar del select múltiple (listbox) y guardar los datos en la tabla intermedia
			if (!empty($listbox1Edit)) {
				for ($i = 0; $i < count($listbox1Edit); $i++) {
					$IdRol = explode(";", $listbox1Edit[$i])[0];
					$datosRolUsuario = ['fkidusuario' => $Id, 'fkidrol' => $IdRol];
					$objRolUsuario = new Entidad($datosRolUsuario);
		
					// Crear un objeto ControlEntidad para la tabla de roles de usuario
					$objControlRolUsuario = new ControlEntidad('rol_usuario');
					
					// Llamar al método guardar con el objeto Entidad
					$objControlRolUsuario->guardar($objRolUsuario);
				}
			}     
			header('Location: vistaUsuarios.php');
			break;			
		case 'Borrar':
			/*
				Arreglar, no está eliminando el rol_usuario
			*/
			$arrUsuario=['email' => $Email];
			$objUsuario = new Entidad($arrUsuario);
			$objControlUsuario = new ControlEntidad('usuario');
			$objControlUsuario->borrar('email', $Email);
			header('Location: vistaUsuarios.php');
			break;
			/*
			$objUsuario = new Usuario(0,"",$Email,"");
			$objControlUsuario = new ControlUsuario($objUsuario);
			$objControlUsuario->borrar();
			header('Location: vistaUsuarios.php');
			break;*/
		case 'Limpiar':
			$Id = 0;
			$Name = "";
			$Email = "";
			$Password = "";	
			$listbox1 = "";	
			header('Location: vistaUsuarios.php');
			break;
		
		default:
			# code...
			break;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Usuarios</title>
<link rel="shortcut icon" href="../img/logo-DBD-01.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/misCss1.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="../js/misFunciones2.js"></script>
<script src="../Usuario/Usuario.js"></script>
<script src="../js/buscador.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--
	Para dataTable
-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

</head>
<body>
	
<!--<div class="container-xl">-->
	<!--Se agrega una barra de navegación para acceder a los CRUDs, y agregar la funcionalidad "buscar"-->	
	<div class="navBar">
			<?php require('../navbar.php')?>
	</div>
	<script>
		$(document).ready( function () {
			$('#tableId').DataTable();
		} );
	</script>
	<div class="table-responsive">
		
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2 class="table-title-name">Gestión <b>Usuarios</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#crudModal" class="btn btn-gestion" data-toggle="modal"><i class="material-icons">&#xe147;</i> <span>Nuevo usuario</span></a>
						
					</div>
				</div>
			</div>
			<!--
				Buscador
			
			<div class="container-fluid">
				<form class="d-flex">
				<input class="form-control me-2 light-table-filter" data-table="table_id" type="text" 
				placeholder="Search...">
				<hr>
				</form>
			</div>-->
			<table class="table table-striped table-hover table_id" id="tableId">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>Nombre</th>
						<th>Correo</th>
						<!--<th>Contraseña</th>-->
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for($i = 0; $i < count($arregloUsuarios); $i++){
					?>
						<tr>
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
							</td>
							<td><?php echo $arregloUsuarios[$i]->__get('Name');?></td>
							<td><?php echo $arregloUsuarios[$i]->__get('Email');?></td>
							<!--<td><?php echo $arregloUsuarios[$i]->__get('Password');?></td>-->
							<td>
								<a href="#crudModalEditUsuario" class="edit" data-toggle="modal" id="<?php echo $arregloUsuarios[$i]->__get('Id');?>" onclick="editModal(<?php echo $arregloUsuarios[$i]->__get('Id');?>,'usuario')">
									<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
								</a>
								<a href="#" class="delete" data-toggle="modal" id="<?php echo $arregloUsuarios[$i]->__get('Id');?>" onclick="DeleteAlert('<?php echo $arregloUsuarios[$i]->__get('Id');?>')">
									<i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
								</a>
								<!--<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>-->
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>		
		</div>
	</div>        
<!--</div>-->
<!-- crud Modal HTML -->
<div id="crudModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="vistaUsuarios.php" method="post">
				<div class="modal-header">						
					<h4 class="modal-title">Usuario</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
						<div class="container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#home">Datos de usuario</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#menu1">Roles por usuario</a>
							</li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div id="home" class="container tab-pane active"><br>								
								
								<input type="int" id="txtId" name="txtId" class="form-control" value="<?php echo $Id ?>" hidden>
								
								<div class="form-group">
								<label>Email</label>
									<input type="email" id="txtEmail" name="txtEmail" class="form-control" value="<?php echo $Email ?>" required>
								</div>
								<div class="form-group">
								<label>Nombre</label>
									<input type="text" id="txtName" name="txtName" class="form-control" value="<?php echo $Name ?>" required>
								</div>
								<div class="form-group">
									<label>Contraseña</label>
									<input type="password" id="txtPassword" name="txtPassword" class="form-control" value="<?php echo $Password ?>" required>
								</div>
								<div class="form-group">
									<button type="button" id="btnGuardar" name="bt" class="btn btn-success"	onclick="PostAlertUser()">Guardar</button>
									<!--<input type="submit" id="btnGuardar" name="bt" class="btn btn-success" value="Guardar">-->							
									<input type="submit" id="btnLimpiar" name="bt" class="btn" value="Limpiar">
								</div>
							</div>
							
							
							<div id="menu1" class="container tab-pane fade"><br>
							<div class="container">
								<div class="form-group">
									<label for="combobox1">Todos los roles</label>
								<select class="form-control" id="combobox1" name="combobox1">
									<?php for($i=0; $i<count($arregloRoles); $i++){ ?>
									<option value="<?php echo $arregloRoles[$i]->__get('Id').";". $arregloRoles[$i]->__get('Name'); ?>">
										<?php echo $arregloRoles[$i]->__get('Id').";". $arregloRoles[$i]->__get('Name'); ?>
									</option>
									<?php } ?>
								</select>
								<br>
								<label for="listbox1">Roles específicos del usuario</label>
								<select multiple class="form-control" id="listbox1" name="listbox1[]">
									<?php for($i=0; $i<count($arregloRolesConsulta); $i++){ ?>
									<option value="<?php echo $arregloRolesConsulta[$i]->__get('Id').";". $arregloRolesConsulta[$i]->__get('Name'); ?>">
										<?php echo $arregloRolesConsulta[$i]->__get('Id').";". $arregloRolesConsulta[$i]->__get('Name'); ?>
									</option>
									<?php } ?>
								</select>
								</div>
									<div class="form-group">
										<button type="button" id="btnAgregarItem" name="bt" class="btn btn-success" onclick="agregarItem('combobox1', 'listbox1')">Agregar Item</button>
										<button type="button" id="btnRemoverItem" name="bt" class="btn btn-success" onclick="removerItem('listbox1')">Remover Item</button>
									</div>
								</div>
							</div>
						</div>
						</div>				
									
				</div>
				<!--<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">					
				</div>-->
			</form>
		</div>
	</div>
</div>

<!-- crud Modal HTML -->
<div id="crudModalEditUsuario" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="vistaUsuarios.php" method="post">
				<div class="modal-header">						
					<h4 class="modal-title">Usuario</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
						<div class="container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#homeEdit">Datos de usuario</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#menuEdit">Roles por usuario</a>
							</li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div id="homeEdit" class="container tab-pane active"><br>								
								
								
								
								<div class="form-group">
								<label>Email</label>
									<input type="email" id="txtEmailEdit" name="txtEmail" value="<?php echo $Email ?>" hidden>
									<input type="email" id="txtEmailEditView" class="form-control" required disabled>
								</div>
								<div class="form-group">
								<label>Nombre</label>
									<input type="text" id="txtNameEdit" name="txtName" class="form-control" value="<?php echo $Name ?>" required>
								</div>
								
								<div class="form-group">
									<input type="submit" id="btnModificar" name="bt" class="btn btn-warning" value="Modificar">
									<input type="submit" id="btnLimpiar" name="bt" class="btn" value="Limpiar">
								</div>
							</div>
							
							
							<div id="menuEdit" class="container tab-pane fade"><br>
							<div class="container">
								<div class="form-group">
									<label for="combobox1Edit">Todos los roles</label>
								<select class="form-control" id="combobox1Edit" name="combobox1Edit">
									<?php for($i=0; $i<count($arregloRoles); $i++){ ?>
									<option value="<?php echo $arregloRoles[$i]->__get('Id').";".$arregloRoles[$i]->__get('Name'); ?>">
										<?php echo $arregloRoles[$i]->__get('Id').";".$arregloRoles[$i]->__get('Name'); ?>
									</option>
									<?php } ?>
								</select>
								<br>
								<label for="listbox1Edit">Roles específicos del usuario</label>
								<select multiple class="form-control" id="listbox1Edit" name="listbox1Edit[]">
									
								</select>
								</div>
									<div class="form-group">
										<button type="button" id="btnAgregarItem" name="bt" class="btn btn-success" onclick="agregarItem('combobox1Edit', 'listbox1Edit')">Agregar Item</button>
										<button type="button" id="btnRemoverItem" name="bt" class="btn btn-success" onclick="removerItem('listbox1Edit')">Remover Item</button>
									</div>
								</div>
							</div>
						</div>
						</div>				
									
				</div>
				<!--<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">					
				</div>-->
			</form>
		</div>
	</div>
</div>


</body>
</html>