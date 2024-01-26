<?php
ob_start();
?>
<?php 
	include '../../controlador/configBd.php';
	include '../../controlador/ControlEntidad.php';
	include '../../controlador/ControlConexionPdo.php';
	include '../../modelo/Entidad.php';
	include 'editar.php';
	include 'guardar.php';
	include 'eliminar.php';

	session_start();
	if($_SESSION['email']==null)header('Location: http://localhost/webSiteEchez/login.php');
  
	$permisoParaEntrar=false;
	  $listaRolesDelUsuario = $_SESSION['listaRolesDelUsuario'];
	  //var_dump($listaRolesDelUsuario);
	  for($i=0;$i<count($listaRolesDelUsuario);$i++){
		  if($listaRolesDelUsuario[$i]->__get('name')=="Admin-Global")
		  $permisoParaEntrar=true;
	  }
	  if(!$permisoParaEntrar)header('Location: http://localhost/webSiteEchez/vista/vistaHome.php');
?>
<?php	

	$objControlRol = new ControlEntidad('rol');
	$arregloRoles = $objControlRol->listar();
	
	//var_dump($arregloRoles);
	$boton = $_POST['bt'] ?? '';//toma del arreglo post el value del bt	
	$TablaName = 'Rol';
	$Name = $_POST['txtName'] ?? '';
	$Description = $_POST['txtDescription'] ?? '';

	//if (isset($_POST['listbox1'])) $listbox1 = $_POST['listbox1'];
	//var_dump($listbox1);
	
	switch ($boton) {
		case 'Guardar':		
			/*	
			$datosRol = ['Name' => $Name,'Description'=>$Description];
			$objRol = new Entidad($datosRol);
			$objControlRol = new ControlEntidad('Rol');
			$objControlRol->guardar($objRol);
			header('Location: vistaRol.php');	*/
			exit;		
			break;		
		case 'Consultar':
			$datosRol=['Name' => $Name];
			$objRol = new Entidad($datosRol); 
			$objControlRol = new ControlEntidad('Rol');
			$objRol = $objControlRol->buscarPorId('Name', $Name);
			
			// Validar si $objRol es nulo antes de acceder a sus propiedades
			if ($objRol !== null) {
				$Description = $objRol->__get('Description');
				
			} else {
				// Manejar el caso en que $objRol es nulo
				echo "El rol no se encontró.";
			}
			break;
		case 'Modificar': 
			// Se debería llamar a un procedimiento almacenado con control de transacciones
			//para modificar en las dos tablas
			//1. modifica en tabla principal    
			$datosRol=['Name' => $Name, 'Description' => $Description];
			$objRol=new Entidad($datosRol);
			$objControlRol = new ControlEntidad('Rol');
			$objControlRol->modificar('Name', $Name, $objRol);
			header('Location: vistaRol.php');
			break;
		case 'Borrar':
			$arrRol=['Name' => $Name];
			$objRol = new Entidad($arrRol);
			$objControlRol = new ControlEntidad('Rol');
			$objControlRol->borrar('Name', $Name);
			header('Location: vistaRol.php');
			break;
		case 'Limpiar':
			$Name = "";
			$Description = "";		
			header('Location: vistaRol.php');
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
<title>Roles</title>
<link rel="shortcut icon" href="../img/logo-DBD-01.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/misCss1.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="../Rol/rol.js"></script>
<script src="../Rol/rol.css"></script>
<script src="../js/buscador.js"></script>
<script src="../js/misFunciones2.js"></script>
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
	<!--<div class="table-responsive">-->
	</form>
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2 class="table-title-name">Gestión <b>Roles</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#crudModal" class="btn btn-gestion" data-toggle="modal"><i class="material-icons">&#xe147;</i> <span>Nuevo rol</span></a>
						
					</div>
				</div>
			</div>
			 
			<!--
			<div class="row">
				
				combo box, para mostrar n numero de registros
			
			<div class="col-auto col-2">
				<select name="num_registros" id="num_registros" class="form-select">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="5">5</option>
				</select>
			</div>		
			
				Buscador
			
			<div class="container-fluid col-3" style="margin-left:55%; margin-botton:10px;">
				<form class="d-flex">
				<input class="form-control me-2 light-table-filter" data-table="table_id" type="text" 
				placeholder="Search...">
				<hr>
				</form>
			</div>
			</div>
	-->
			<table class="table table-striped table-hover  table_id" id="tableId">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>Nombre</th>
						<th>Descripción</th>
						<th style="width:20px;">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for($i = 0; $i < count($arregloRoles); $i++){
					?>
						<tr>
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
							</td>
							<td><?php echo $arregloRoles[$i]->__get('Name');?></td>
							<td><?php echo $arregloRoles[$i]->__get('Description');?></td>
							<td>
								<a href="#crudModalEdit" class="edit" data-toggle="modal" id="<?php echo $arregloRoles[$i]->__get('Id');?>" onclick="editModal(<?php echo $arregloRoles[$i]->__get('Id');?>,'<?php echo $TablaName ?>')">
									<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
								</a>								
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			<!--
			<div class="clearfix">
				<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
				<ul class="pagination">
					<li class="page-item disabled"><a href="#">Previous</a></li>
					<li class="page-item"><a href="#" class="page-link">1</a></li>
					<li class="page-item"><a href="#" class="page-link">2</a></li>
					<li class="page-item active"><a href="#" class="page-link">3</a></li>
					<li class="page-item"><a href="#" class="page-link">4</a></li>
					<li class="page-item"><a href="#" class="page-link">5</a></li>
					<li class="page-item"><a href="#" class="page-link">Next</a></li>
				</ul>
			</div>-->
		</div>
	<!--</div>   -->     
<!--</div>-->
<!-- crud Modal HTML -->
<div id="crudModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="vistaRol.php" method="post">
				<div class="modal-header">						
					<h4 class="modal-title">Rol</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
						<div class="container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#home">Datos del Rol</a>
							</li>
							<!--<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#menu1">Roles por Rol</a>
							</li>-->
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div id="home" class="container tab-pane active"><br>
							<div class="form-group">
								<label>Nombre</label>
									<input type="Name" id="txtName" name="txtName" class="form-control" value="<?php echo $Name ?>">
								</div>
								<div class="form-group">
									<label>Descripción</label>
									<input type="text" id="txtDescription" name="txtDescription" class="form-control" value="<?php echo $Description ?>">
								</div>
								<div class="form-group">
									<!--<input type="submit" id="btnGuardar" name="bt" class="btn btn-primary" value="Guardar">-->
									<button type="button" id="btnGuardar" name="bt" class="btn btn-success"	onclick="PostAlertRol()">Guardar</button>
									<input type="submit" id="btnLimpiar" name="bt" class="btn" value="Limpiar">
								</div>
							</div>													
							
						</div>
						</div>				
									
				</div>
			</form>
		</div>
	</div>
</div>

<div id="crudModalEdit" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        <form action="vistaRol.php" method="post">
            <div class="modal-header">						
                <h4 class="modal-title">Rol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                
                    <div class="container">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Datos del Rol</a>
                        </li>
                        <!--<li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">Roles por Rol</a>
                        </li>-->
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active"><br>
                        <div class="form-group">
                            <label>Nombre</label>
                                <input type="Name" id="txtNameEdit" name="txtName" class="form-control" value="<?php echo $Name ?>">
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <input type="text" id="txtDescriptionEdit" name="txtDescription" class="form-control" value="<?php echo $Description ?>">
                            </div>
                            <div class="form-group">                             
                                <input type="submit" id="btnModificar" name="bt" class="btn btn-warning" value="Modificar">                               
                            </div>
                        </div>													
                        
                    </div>
                    </div>				
                                
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>