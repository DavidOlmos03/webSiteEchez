<?php
ob_start();
?>
<?php 
	include '../../controlador/configBd.php';	
	include '../../controlador/ControlEntidad.php';
	include '../../controlador/ControlConexionPdo.php';
	include '../../modelo/Entidad.php';

  	session_start();
  	if($_SESSION['email']==null)header('Location: http://localhost/webSiteEchez/login.php');

  	$permisoParaEntrar=false;
	$listaRolesDelUsuario = $_SESSION['listaRolesDelUsuario'];
	//var_dump($listaRolesDelUsuario);
	
	for($i=0;$i<count($listaRolesDelUsuario);$i++){
		if($listaRolesDelUsuario[$i]->__get('name')=="Admin" || $listaRolesDelUsuario[$i]->__get('name')=="Admin-Global")
		$permisoParaEntrar=true;
	}
	$navbar = 0;
	$bandera1 = false;
	//var_dump($listaRolesDelUsuario);
	for($i=0;$i<count($listaRolesDelUsuario);$i++){
        
        if($listaRolesDelUsuario[$i]->__get('name')=="Admin-Global"){
            $navbar=0;
            $bandera1 = true;
            
        }else if($listaRolesDelUsuario[$i]->__get('name')=="Admin" && $bandera1 != true){
			$navbar = 1;
            
		}	
        
	}  
	if(!$permisoParaEntrar)header('Location: http://localhost/webSiteEchez/vista/vistaHome.php');
?>
<?php
	
	$objControlAlquilado = new ControlEntidad('alquilado');

	$statusFilter = $_GET['status'] ?? 'activos'; // Obtener el filtro de estado desde la URL
	$conditions = [];

	if ($statusFilter === 'activos') {
    	$conditions['Status_PC'] = 1;
	} elseif ($statusFilter === 'inactivos') {
    	$conditions['Status_PC'] = 0;
	}

	$arregloAlquilado = $objControlAlquilado->listar($conditions);
	$TablaName ='alquilado';
	$boton = $_POST['bt'] ?? '';//toma del arreglo post el value del bt	
	$Id = $_POST['txtId'] ?? '';
	$User_Name = $_POST['txtUser_Name'] ?? '';
	$Serial = $_POST['txtSerial'] ?? '';
	$PC_Name = $_POST['txtPC_Name'] ?? '';
	$Installation_Date = $_POST['txtInstallation_Date'] ?? '';
	$Plate_PC = $_POST['txtPlate_PC'] ?? '';
	$Specifications = $_POST['txtSpecifications'] ?? '';
	$Ram = $_POST['txtRam'] ?? '';
	$Desktop_Laptop = $_POST['txtDesktop_Laptop'] ?? '';
	$Domain = $_POST['txtDomain'] ?? '';
	$Status_PC = $_POST['txtStatus_PC'] ?? '';
	$dateUpdate_Date = $_POST['txtdateUpdate_Date'] ?? '';
	//if (isset($_POST['listbox1'])) $listbox1 = $_POST['listbox1'];
	//var_dump($listbox1);
	switch ($boton) {
		case 'Guardar':
			//session_start();
            //$_SESSION['msj'] = "se registró el usuario de forma correcta";
			$datosAlquilado = ['User_Name'=> $User_Name,'Serial'=> $Serial,'PC_Name'=> $PC_Name,'Installation_Date'=> $Installation_Date,'Plate_PC'=> $Plate_PC,'Specifications'=> $Specifications,
	        'Ram'=>$Ram,'Desktop_Laptop'=> $Desktop_Laptop,'Domain'=> $Domain,'Status_PC'=> $Status_PC,'dateUpdate_Date'=> $dateUpdate_Date];
			$objAlquilado = new Entidad($datosAlquilado);
			$objControlAlquilado = new ControlEntidad('Alquilado');
			$objControlAlquilado->guardar($objAlquilado);
			
			$bandera = 1;
			header('Location: vistaAlquilado.php');			
			break;
		case 'Consultar':
			$datosAlquilado = ['Serial'=>$Serial];
			$objAlquilado = new Entidad($datosAlquilado);
			$objControlAlquilado = new ControlEntidad('Alquilado');
			$objAlquilado = $objControlAlquilado->buscarPorId('Serial', $Serial);

			// Validar si $objAlquilado es nulo antes de acceder a sus propiedades
			if ($objAlquilado !== null) {
				$User_Name = $objAlquilado->__get('User_Name');
				$PC_Name = $objAlquilado->__get('PC_Name');
				$Installation_Date = $objAlquilado->__get('Installation_Date');
				$Plate_PC = $objAlquilado->__get('Plate_PC');
				$Specifications = $objAlquilado->__get('Specifications');
				$Ram = $objAlquilado->__get('Ram');
				$Desktop_Laptop = $objAlquilado->__get('Desktop_Laptop');
				$Domain = $objAlquilado->__get('Domain');
				$Status_PC = $objAlquilado->__get('Status_PC');
				$dateUpdate_Date = $objAlquilado->__get('dateUpdate_Date');	
				
			} else {
				// Manejar el caso en que $objAlquilado es nulo
				echo "El PC Alquilado no se encontró.";
			}							
			//var_dump($arregloRolesConsulta);*/
			break;
		case 'Modificar': 
			$datosAlquilado = ['User_Name'=> $User_Name,'Serial'=> $Serial,'PC_Name'=> $PC_Name,'Installation_Date'=> $Installation_Date,'Plate_PC'=> $Plate_PC,'Specifications'=> $Specifications,
	        'Ram'=>$Ram,'Desktop_Laptop'=> $Desktop_Laptop,'Domain'=> $Domain,'Status_PC'=> $Status_PC,'dateUpdate_Date'=> $dateUpdate_Date];
			$objAlquilado = new Entidad($datosAlquilado);
			$objControlAlquilado = new ControlEntidad('Alquilado');
			$objControlAlquilado -> modificar('Serial',$Serial,$objAlquilado);
			

			header('Location: vistaAlquilado.php');
			break;
		case 'Borrar':
			$arrAlquilado=['Serial' => $Serial];
			$objAlquilado = new Entidad($arrAlquilado);
			$objControlAlquilado = new ControlEntidad('Alquilado');
			$objControlAlquilado->borrar('Serial', $Serial);
			header('Location: vistaAlquilado.php');
			break;
		case 'Limpiar':
			$Id = "";
			$User_Name = "";
			$Serial = "";
			$PC_Name = "";
			$Installation_Date = "";
			$Plate_PC = "";
			$Specifications = "";
			$Ram = "";
			$Desktop_Laptop = "";
			$Domain = "";
			$Status_PC = "";
			$dateUpdate_Date = "";		
			header('Location: vistaAlquilado.php');
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
<title class="rented-text">PCs Alquilados</title>
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
<script src="../Alquilado/Alquilado.js"></script>
<script src="../js/buscador.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--
	Para dataTable
-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
</head>
<body>
	<!--<script>alert('Usuario registrado');</script>-->
<!--<div class="container-xl">-->
	<!--Se agrega una barra de navegación para acceder a los CRUDs, y agregar la funcionalidad "buscar"-->	
	<div class="navBar">
		<?php if($navbar==0){
			require('../navbar.php');
		} else if ($navbar==1) {require('../navbar_admin.php');}
		?>
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
						<h2 class="table-title-name rented-text">PCs Alquilados</h2>
					</div>
					<div class="col-sm-6">
						<a href="#crudModal" class="btn btn-gestion" data-toggle="modal"><i class="material-icons">&#xE30C;</i> <span class="addPc-text">Agregar nuevo PC</span></a>
					</div>
				</div>				
			</div>
			<div class="row">
					<div class="col-sm-6">						
						<a class="btn btn-activos active-text" href="vistaAlquilado.php?status=activos"><span>Activos</span></a>
						|
						<a class="btn btn-inactivos inactive-text" href="vistaAlquilado.php?status=inactivos"><span>Inactivos</span></a>
						|
						<a class="btn btn-inactivos all-text" href="vistaAlquilado.php?status=''"><span>Todos</span></a>
					</div>
					<div class="col-sm-6">
						
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
						<!--
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>-->
						<!--<th>Id</th>-->
						<th class="user-text">Usuario</th>
						<th>Serial</th>
						<th class="pcName-text">Nombre PC</th>
						<th class="installationDate-text">Fecha de instalación</th>
						<th class="platePc-text">Placa PC</th>
						<th class="specifications-text">Especificaciones</th>
						<th>Ram</th>
						<th><span class="desktop-text">Desktop</span> / <span class="laptop-text">Laptop</span></th>
						<th class="domain-text">Dominio</th>
						<th class="statusPc-text">Estado PC</th>
						<th class="dateUpdated-text">Fecha actualizada</th>
						<th style="width:20px;" class="actions-text">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for($i = 0; $i < count($arregloAlquilado); $i++){
					?>
						<tr>
							<!--<td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
							</td>	-->					
							<td><?php echo $arregloAlquilado[$i]->__get('User_Name');?></td>
							<td><?php echo $arregloAlquilado[$i]->__get('Serial');?></td>
							<td><?php echo $arregloAlquilado[$i]->__get('PC_Name');?></td>
							<td><?php echo $arregloAlquilado[$i]->__get('Installation_Date');?></td>
							<td><?php echo $arregloAlquilado[$i]->__get('Plate_PC');?></td>
							<td><?php echo $arregloAlquilado[$i]->__get('Specifications');?></td>
							<td><?php echo $arregloAlquilado[$i]->__get('Ram');?></td>
							<td><?php echo $arregloAlquilado[$i]->__get('Desktop_Laptop');?></td>
							<td><?php echo $arregloAlquilado[$i]->__get('Domain');?></td>
							<!--<td><?php echo $arregloAlquilado[$i]->__get('Status_PC');?></td>-->
							<td><?php $status = $arregloAlquilado[$i]->__get('Status_PC');echo ($status == 1) ? 'Activo' : 'Inactivo';?>
							</td>
							<td><?php echo $arregloAlquilado[$i]->__get('dateUpdate_Date');?></td>
							<td>
							<a href="#crudModalEdit" class="edit" data-toggle="modal" id="<?php echo $arregloAlquilado[$i]->__get('Id');?>" onclick="editModal(<?php echo $arregloAlquilado[$i]->__get('Id');?>,'<?php echo $TablaName ?>')">
									<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
								</a>							
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
			<form action="vistaAlquilado.php" method="post">
				<div class="modal-header">						
					<h4 class="modal-title">PC Alquilado</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
						<div class="container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#home">Datos del PC</a>
							</li>							
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div id="home" class="container tab-pane active"><br>
							<div class="row">
							    <div class="form-group col-md-6">
								<label class="userName-text">Nombre usuario</label>
									<input type="User_Name" id="txtUser_Name" name="txtUser_Name" class="form-control" 
									value="<?php echo $User_Name ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label>Serial</label>
									<input type="text" id="txtSerial" name="txtSerial" class="form-control" 
									value="<?php echo $Serial ?>" style="border-radius: 10px">
								</div>							
							</div>	
							<div class="row">	
								<div class="form-group col-md-6">
								<label class="pcName-text">Nombre PC</label>
									<input type="PC_Name" id="txtPC_Name" name="txtPC_Name" class="form-control" 
									value="<?php echo $PC_Name ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label class="installationDate-text">Fecha de instalación</label>
									<input type="date" id="txtInstallation_Date" name="txtInstallation_Date" class="form-control" 
									value="<?php echo $Installation_Date ?>" style="border-radius: 10px">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label class="platePc-text">Plate PC</label>
									<input type="txt" id="txtPlate_PC" name="txtPlate_PC" class="form-control" 
									value="<?php echo $Plate_PC ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label class="specifications-text">Especificaciones</label>
									<input type="text" id="txtSpecifications" name="txtSpecifications" class="form-control" 
									value="<?php echo $Specifications ?>" style="border-radius: 10px">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label>Ram</label>
									<input type="Ram" id="txtRam" name="txtRam" class="form-control" 
									value="<?php echo $Ram ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label><span class="desktop-text">Desktop</span>/<span class="laptop-text">Laptop</span></label>									
									<select id="txtDesktop_Laptop" name="txtDesktop_Laptop" class="form-control" 
									 style="border-radius: 10px" >
										<option <?php echo ($Desktop_Laptop === 'Desktop')? 'selected' : ''; ?>>Desktop</option>
										<option <?php echo ($Desktop_Laptop === 'Laptop') ? 'selected' : ''; ?>>Laptop</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label class="domain-text">Dominio</label>
									<!--<input type="Domain" id="txtDomain" name="txtDomain" class="form-control" 
									value="<?php echo $Domain ?>" style="border-radius: 10px">-->
									<select id="txtDomain" name="txtDomain" class="form-control" 
									value="<?php echo $Domain ?>" style="border-radius: 10px" >
										<option selected>Echez</option>					
									</select>
								</div>
								<div class="form-group col-md-6">
									<label class="statusPc-text">Estado PC</label>				
									<select id="txtStatus_PC" name="txtStatus_PC" class="form-control" 
									value="<?php echo $Status_PC ?>" style="border-radius: 10px" >
										<option <?php echo ($Status_PC === '1')? 'selected' : ''; ?>>1</option>
										<option <?php echo ($Status_PC === '0')? 'selected' : ''; ?>>0</option>
									</select>
								</div>
							</div>
								<div class="form-group">
									<label class="dateUpdated-text">Date update</label>
									<input type="date" id="txtdateUpdate_Date" name="txtdateUpdate_Date" class="form-control" 
									value="<?php echo $dateUpdate_Date ?>" style="border-radius: 10px">
								</div>
			
								<div class="form-group">
									<button type="button" id="btnGuardar" name="bt" class="btn btn-success save-text"	onclick="PostAlert()">Guardar</button>				
									
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

<!-- crud Modal HTML para boton Editar-->
<div id="crudModalEdit" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="vistaAlquilado.php" method="post">
				<div class="modal-header">						
					<h4 class="modal-title">PC Alquilado</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
					<div class="container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#homeEdit">Datos del PC</a>
							</li>						
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div id="homeEdit" class="container tab-pane active"><br>
							<div class="row">
							    <div class="form-group col-md-6">
								<label class="pcName-text">Nombre usuario</label>
									<input type="text" id="txtUser_NameEdit" name="txtUser_Name" class="form-control" 
									value="<?php echo $User_Name ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label>Serial</label>
									<input type="text" id="txtSerialEdit" name="txtSerial" class="form-control" 
									value="<?php echo $Serial ?>" style="border-radius: 10px">
								</div>							
							</div>	
							<div class="row">	
								<div class="form-group col-md-6">
								<label  class="pcName-text">Nombre PC</label>
									<input type="text" id="txtPC_NameEdit" name="txtPC_Name" class="form-control" 
									value="<?php echo $PC_Name ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label class="installationDate-text">Fecha de instalación</label>
									<input type="date" id="txtInstallation_DateEdit" name="txtInstallation_Date" class="form-control" 
									value="<?php echo $Installation_Date ?>" style="border-radius: 10px">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label class="platePc-text">Plate PC</label>
									<input type="txt" id="txtPlate_PCEdit" name="txtPlate_PC" class="form-control" 
									value="<?php echo $Plate_PC ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label class="specifications-text">Especificaciones</label>
									<input type="text" id="txtSpecificationsEdit" name="txtSpecifications" class="form-control" 
									value="<?php echo $Specifications ?>" style="border-radius: 10px">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label>Ram</label>
									<input type="txt" id="txtRamEdit" name="txtRam" class="form-control" 
									value="<?php echo $Ram ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label><span class="desktop-text">Desktop</span>/<span class="laptop-text">Laptop</span></label>									
									<select id="txtDesktop_LaptopEdit" name="txtDesktop_Laptop" class="form-control" 
									 style="border-radius: 10px" >
										<option <?php echo ($Desktop_Laptop === 'Desktop')? 'selected' : ''; ?>>Desktop</option>
										<option <?php echo ($Desktop_Laptop === 'Laptop') ? 'selected' : ''; ?>>Laptop</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label class="domain-text">Dominio</label>
									<!--<input type="Domain" id="txtDomain" name="txtDomain" class="form-control" 
									value="<?php echo $Domain ?>" style="border-radius: 10px">-->
									<select id="txtDomainEdit" name="txtDomain" class="form-control" 
									value="<?php echo $Domain ?>" style="border-radius: 10px" >
										<option selected>Echez</option>
										<option selected>Complarketing</option>						
									</select>
								</div>
								<div class="form-group col-md-6">
									<label class="statusPc-text">Estado PC</label>				
									<select id="txtStatus_PCEdit" name="txtStatus_PC" class="form-control" 
									value="<?php echo $Status_PC ?>" style="border-radius: 10px" >
										<option <?php echo ($Status_PC === '1')? 'selected' : ''; ?>>1</option>
										<option <?php echo ($Status_PC === '0')? 'selected' : ''; ?>>0</option>
									</select>
								</div>
							</div>
								<div class="form-group">
									<label class="dateUpdated-text">Date update</label>
									<input type="date" id="txtdateUpdate_DateEdit" name="txtdateUpdate_Date" class="form-control" 
									value="<?php echo $dateUpdate_Date ?>" style="border-radius: 10px">
								</div>
			
								<div class="form-group">
									<input type="submit" id="btnModificar" name="bt" class="btn btn-warning" value="Modificar">
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

</body>
</html>