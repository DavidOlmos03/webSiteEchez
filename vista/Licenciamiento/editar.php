<?php
  if(isset($_GET['Id']) && isset($_GET['TableName'])) {
    $IdElemento = $_GET['Id'];
    $TableName = $_GET['TableName'];
    // Realizar las operaciones necesarias para eliminar el elemento
    // Puede ser una operación en la base de datos, por ejemplo
    include '../../controlador/configBd.php';
    include '../../controlador/ControlEntidad.php';
    include '../../controlador/ControlConexionPdo.php';
    include '../../modelo/Entidad.php';

    //echo "Id proporcionado: $idElemento";
    //
      $datosLicenciamiento=['Id' => $IdElemento];
			$objLicenciamiento = new Entidad($datosLicenciamiento); 
			$objControlLicenciamiento = new ControlEntidad($TableName);
			$objLicenciamiento = $objControlLicenciamiento->buscarPorId('Id', $IdElemento);
			
			// Validar si $objRol es nulo antes de acceder a sus propiedades
			if ($objLicenciamiento !== null) {
                $datos = [
                    //'Id' => $objLicenciamiento->__get('Id'),
                    'Applicant' => $objLicenciamiento->__get('Applicant'),
                    'Area' => $objLicenciamiento->__get('Area'),
                    'StartDate' => $objLicenciamiento->__get('StartDate'),
                    'EndDate' => $objLicenciamiento->__get('EndDate'),
                    'LicenseType' => $objLicenciamiento->__get('LicenseType'),
                    'Budget' => $objLicenciamiento->__get('Budget'),
                    'Cost' => $objLicenciamiento->__get('Cost'),
                    'Quantity' => $objLicenciamiento->__get('Quantity'),
                    'CostCenter' => $objLicenciamiento->__get('CostCenter'),
                ];
        
                // Convertir el array a formato JSON
                $jsonResponse = json_encode($datos);
        
                // Devolver la respuesta JSON
                echo $jsonResponse;
			} else {
				// Manejar el caso en que $objRol es nulo
                echo json_encode(['error' => 'El registro no se encontró.']);
			}          
  } 
  
?>

