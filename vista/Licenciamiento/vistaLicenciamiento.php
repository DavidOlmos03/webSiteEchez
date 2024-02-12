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

	$objControlFormularioFlujo = new ControlEntidad('formulario_licenciamiento');
	$arregloFormularioFlujo = $objControlFormularioFlujo->listar();

	/*$objControlRol = new ControlRol(null);
	$arregloRoles = $objControlRol->listar();*/
	//var_dump($arregloRoles);
	$boton = $_POST['bt'] ?? '';//toma del arreglo post el value del bt	
	$Id = $_POST['txtId'] ?? '';
	$Applicant = $_POST['txtApplicant'] ?? '';
	$Area = $_POST['txtArea'] ?? '';
	$StartDate = $_POST['txtStartDate'] ?? '';
	$EndDate = $_POST['txtEndDate'] ?? '';
	$LicenseType = $_POST['txtLicenseType'] ?? '';
	$Budget = $_POST['txtBudget'] ?? '';
	$Cost = $_POST['txtCost'] ?? '';
	$Quantity = $_POST['txtQuantity'] ?? '';
    $CostCenter = $_POST['txtCostCenter'] ?? '';
	$TablaName ="formulario_licenciamiento";
	//if (isset($_POST['listbox1'])) $listbox1 = $_POST['listbox1'];
	//var_dump($listbox1);
	switch ($boton) {
		case 'Guardar':
			//session_start();
            //$_SESSION['msj'] = "se registró el Rol de forma correcta";
			$datosLicenciamiento = ['Id'=>$Id,'Applicant'=>$Applicant,'Area'=>	$Area,'LicenseType'=>$LicenseType,'Budget'=>$Budget,
			'Cost'=>$Cost,'StartDate'=>$StartDate,'EndDate'=>	$EndDate,'CostCenter'=>	$CostCenter,'Quantity'=>$Quantity];
			$objLicenciamiento = new Entidad($datosLicenciamiento);
			$objControlLicenciamiento = new ControlEntidad('formulario_licenciamiento');
			$objControlLicenciamiento->guardar($objLicenciamiento);	
			header('Location: vistaLicenciamiento.php');			
			break;
		case 'Consultar':
			$datosLicenciamiento = ['Applicant'=>$Applicant];
			$objLicenciamiento = new Entidad($datosLicenciamiento);
			$objControlLicenciamiento = new ControlEntidad('formulario_licenciamiento');
			$objLicenciamiento = $objControlLicenciamiento->buscarPorId('Applicant', $Applicant);

			// Validar si $objLicenciamineto es nulo antes de acceder a sus propiedades
			if ($objLicenciamiento !== null) {
				$Applicant = $objLicenciamiento->__get('Applicant');
				$Area = $objLicenciamiento->__get('Area');
				$StartDate = $objLicenciamiento->__get('StartDate');
				$EndDate = $objLicenciamiento->__get('EndDate');
				$LicenseType = $objLicenciamiento->__get('LicenseType');
				$Budget = $objLicenciamiento->__get('Budget');
				$Cost = $objLicenciamiento->__get('Cost');
				$Quantity = $objLicenciamiento->__get('Quantity');
				$CostCenter = $objLicenciamiento->__get('CostCenter');
				
			} else {
				// Manejar el caso en que $objLicenciamiento es nulo
				echo "El PC Alquilado no se encontró.";
			}

			//var_dump($arregloRolesConsulta);*/
			break;
		case 'Modificar': 
			$datosLicenciamiento = ['Applicant'=>$Applicant,'Area'=>	$Area,'LicenseType'=>$LicenseType,'Budget'=>$Budget,
			'Cost'=>$Cost,'StartDate'=>$StartDate,'EndDate'=>	$EndDate,'CostCenter'=>	$CostCenter,'Quantity'=>$Quantity];
			$objLicenciamiento = new Entidad($datosLicenciamiento);
			$objControlLicenciamiento = new ControlEntidad('formulario_licenciamiento');
			$objControlLicenciamiento -> modificar('Applicant',$Applicant,$objLicenciamiento);
			

			header('Location: vistaLicenciamiento.php');
			break;
		case 'Borrar':
			$arrLicenciamiento=['Applicant' => $Applicant];
			$objLicenciamiento = new Entidad($arrLicenciamiento);
			$objControlLicenciamiento = new ControlEntidad('formulario_licenciamiento');
			$objControlAlquilado->borrar('Applicant', $Applicant);
			header('Location: vistaLicenciamiento.php');
			/*$objUsuario = new Usuario($ema, "");
			$objControlUsuario = new ControlUsuario($objUsuario);
			$objControlUsuario->borrar();
			header('Location: vistaUsuarios.php');*/
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
<title class="licensingWord-text">Licenciamiento</title>
<link rel="shortcut icon" href="../img/logo-DBD-01.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<!--
	Script y estilos personalizodos
-->
<script src="../js/misFunciones2.js"></script>
<script src="../Licenciamiento/Licenciamiento.js"></script>
<script src="../js/buscador.js"></script>
<link rel="stylesheet" href="../css/misCss1.css">

<!--
	Para utilizar Sweet Alert
-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--
	Para dataTable
-->

<link href="https://cdn.datatables.net/1.13.10/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/autofill/2.6.0/css/autoFill.dataTables.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/1.13.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
<!--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-egTjMzYkmIosY1LGfAjQyOetbIw8jx2pQ+y4khg9wSpYsl0G4VbH5p9vFGoRb5uxfdQWlCLzQ/LcT2UrjyoF9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
-->

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
    $(document).ready(function() {
        $('#tableId').DataTable({
            dom: 'lBfrtip',
			lengthMenu: [10, 25, 50, 75, 100], // Define las opciones del selector de cantidad de registros por vista
            pageLength: 10, // Define la cantidad de registros por defecto por vista
            buttons: [
				{
					extend:'excel',			
					titleAttr:'Export to Excel'
				}
            ]            
        });
    });
</script>

	<div class="table-responsive" style="margin-top: 5%">
		
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2 class="table-title-name"><b class="licensingWord-text">Licenciamiento</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#crudModal" class="btn btn-gestion" data-toggle="modal"><i class="material-icons">&#xE84E;</i> <span class="licensing-text">Formulario licenciamiento</span></a>						
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
			<table class="table table-striped table-hover table_id" id="tableId" style="margin-top: 5%">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<!--<th>Id</th>-->
						<th class="applicant-text">Solicitante</th>
						<th class="area-text">Área</th>
						<!--<th>SW</th>-->
						<th class="licenseType-text">Tipo licencia</th>
						<th class="budget-text">Presupuesto</th>
						<th class="cost-text">Costo</th>
						<th class="startDate-text">Fecha Inicio</th>
						<th class="endDate-text">Fecha Fin</th>
						<th class="constCenter-text">Centro de costos</th>
						<th class="quantity-text">Cantidad</th>
						<th class="actions-text" style="width:20px;">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for($i = 0; $i < count($arregloFormularioFlujo); $i++){
					?>
						<tr>
							<td>
								<span class="custom-checkbox">
									<input type="checkbox" id="checkbox1" name="options[]" value="1">
									<label for="checkbox1"></label>
								</span>
							</td>							
							<td><?php echo $arregloFormularioFlujo[$i]->__get('Applicant');?></td>
							<td><?php echo $arregloFormularioFlujo[$i]->__get('Area');?></td>
							<td><?php echo $arregloFormularioFlujo[$i]->__get('LicenseType');?></td>
							<td><?php echo $arregloFormularioFlujo[$i]->__get('Budget');?></td>
							<td><?php echo $arregloFormularioFlujo[$i]->__get('Cost');?></td>
							<td><?php echo $arregloFormularioFlujo[$i]->__get('StartDate');?></td>
							<td><?php echo $arregloFormularioFlujo[$i]->__get('EndDate');?></td>
							<td><?php echo $arregloFormularioFlujo[$i]->__get('CostCenter');?></td>
							<td><?php echo $arregloFormularioFlujo[$i]->__get('Quantity');?></td>
							<td>
							<a href="#ModalEdit" class="edit" data-toggle="modal" id="<?php echo $arregloFormularioFlujo[$i]->__get('Id');?>" onclick="editModal(<?php echo $arregloFormularioFlujo[$i]->__get('Id');?>,'<?php echo $TablaName ?>')">
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
			<form action="vistaLicenciamiento.php" method="post">
				<div class="modal-header">						
					<h4 class="modal-title licensing-text">Formulario licenciamiento</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
						<div class="container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
							<a class="nav-link active data-text" data-toggle="tab" href="#home">Datos</a>
							</li>
							<!--<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#menu1">Roles por usuario</a>
							</li>-->
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div id="home" class="container tab-pane active"><br>

							<input type="int" id="txtId" name="txtId" class="form-control" 
									value="<?php echo $Id ?>" style="border-radius: 10px" hidden>
							<div class="row">
							    <div class="form-group col-md-6">
								<label class="applicant-text">Solicitante</label>
									<input type="text" id="txtApplicant" name="txtApplicant" class="form-control" 
									value="<?php echo $Applicant ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label class="area-text">Área</label>
									<input type="text" id="txtArea" name="txtArea" class="form-control" 
									value="<?php echo $Area ?>" style="border-radius: 10px">
								</div>							
							</div>	
							<div class="row">	
								
								<div class="form-group col-md-6">
									<label class="startDate-text">Fecha inicio</label>
									<input type="date" id="txtStartDate" name="txtStartDate" class="form-control" 
									value="<?php echo $StartDate ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label class="endDate-text">Fecha fin</label>
									<input type="date" id="txtEndDate" name="txtEndDate" class="form-control" 
									value="<?php echo $EndDate ?>" style="border-radius: 10px">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label class="licenseType-text">Tipo licencia</label>
									<input type="txt" id="txtLicenseType" name="txtLicenseType" class="form-control" 
									value="<?php echo $LicenseType ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label class="budget-text">Presupuesto</label>
									<input type="int" id="txtBudget" name="txtBudget" class="form-control" 
									value="<?php echo $Budget ?>" style="border-radius: 10px">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label class="quantity-text">Cantidad</label>
									<input type="Ram" id="txtQuantity" name="txtQuantity" class="form-control" 
									value="<?php echo $Quantity ?>" style="border-radius: 10px">
								</div>
								
								<div class="form-group col-md-6">
									<label class="constCenter-text">Centro de costos</label>
									<select id="txtCostCenter" name="txtCostCenter" class="form-control" style="border-radius: 10px">
										<option <?php echo ($CostCenter === 'CPK') ? 'selected' : ''; ?>>CPK</option>
										<option <?php echo ($CostCenter === 'Echez') ? 'selected' : ''; ?>>Echez</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label class="cost-text">Costo</label>
									<input type="Ram" id="txtCost" name="txtCost" class="form-control" 
									value="<?php echo $Cost ?>" style="border-radius: 10px">
								</div>					
							</div>
																						
								<div class="form-group">
									<input type="submit" id="btnGuardar" name="bt" class="btn btn-primary" value="Guardar">
									<input type="submit" id="btnConsultar" name="bt" class="btn btn-success" value="Consultar">
									<input type="submit" id="btnModificar" name="bt" class="btn btn-warning" value="Modificar">
									<input type="submit" id="btnBorrar" name="bt" class="btn btn-danger" value="Borrar">
									<input type="submit" id="btnLimpiar" name="bt" class="btn btn-warning" value="Limpiar">
								</div>
							</div>																			
						</div>
						</div>				
									
				</div>			
			</form>
		</div>
	</div>
</div>
<!-- Modal para el boton editar HTML -->
<div id="ModalEdit" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="vistaLicenciamiento.php" method="post">
				<div class="modal-header">						
					<h4 class="modal-title licensing-text">Formulario licenciamiento</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					
						<div class="container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
							<a class="nav-link active data-text" data-toggle="tab" href="#homeEdit">Datos</a>
							</li>
							<!--<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#menu1">Roles por usuario</a>
							</li>-->
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div id="homeEdit" class="container tab-pane active"><br>

							<input type="int" id="txtIdEdit" name="txtId" class="form-control" 
									value="<?php echo $Id ?>" style="border-radius: 10px" hidden>
							<div class="row">
							    <div class="form-group col-md-6">
								<label class="applicant-text">Solicitante</label>
									<input type="text" id="txtApplicantEdit" name="txtApplicant" class="form-control" 
									value="<?php echo $Applicant ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label class="area-text">Área</label>
									<input type="text" id="txtAreaEdit" name="txtArea" class="form-control" 
									value="<?php echo $Area ?>" style="border-radius: 10px">
								</div>							
							</div>	
							<div class="row">	
								
								<div class="form-group col-md-6">
									<label class="startDate-text">Fecha inicio</label>
									<input type="date" id="txtStartDateEdit" name="txtStartDate" class="form-control" 
									value="<?php echo $StartDate ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label class="endDate-text">Fecha fin</label>
									<input type="date" id="txtEndDateEdit" name="txtEndDate" class="form-control" 
									value="<?php echo $EndDate ?>" style="border-radius: 10px">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label class="licenseType-text">Tipo licencia</label>
									<input type="txt" id="txtLicenseTypeEdit" name="txtLicenseType" class="form-control" 
									value="<?php echo $LicenseType ?>" style="border-radius: 10px">
								</div>
								<div class="form-group col-md-6">
									<label class="budget-text">Presupuesto</label>
									<input type="int" id="txtBudgetEdit" name="txtBudget" class="form-control" 
									value="<?php echo $Budget ?>" style="border-radius: 10px">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label class="quantity-text">Cantidad</label>
									<input type="Ram" id="txtQuantityEdit" name="txtQuantity" class="form-control" 
									value="<?php echo $Quantity ?>" style="border-radius: 10px">
								</div>
								
								<div class="form-group col-md-6">
									<label class="constCenter-text">Centro de costos</label>
									<select id="txtCostCenterEdit" name="txtCostCenter" class="form-control" style="border-radius: 10px">
										<option <?php echo ($CostCenter === 'CPK') ? 'selected' : ''; ?>>CPK</option>
										<option <?php echo ($CostCenter === 'Echez') ? 'selected' : ''; ?>>Echez</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
								<label class="cost-text">Costo</label>
									<input type="Ram" id="txtCostEdit" name="txtCost" class="form-control" 
									value="<?php echo $Cost ?>" style="border-radius: 10px">
								</div>					
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