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
      $datosRol=['Id' => $IdElemento];
			$objRol = new Entidad($datosRol); 
			$objControlRol = new ControlEntidad($TableName);
			$objRol = $objControlRol->buscarPorId('Id', $IdElemento);
			
			// Validar si $objRol es nulo antes de acceder a sus propiedades
			if ($objRol !== null) {
                $datos = [
                    'Id' => $objRol->__get('Id'),
                    'Name' => $objRol->__get('Name'),
                    'Description' => $objRol->__get('Description')
                ];
        
                // Convertir el array a formato JSON
                $jsonResponse = json_encode($datos);
        
                // Devolver la respuesta JSON
                echo $jsonResponse;
			} else {
				// Manejar el caso en que $objRol es nulo
                echo json_encode(['error' => 'El rol no se encontró.']);
			}          
  } 
  
?>

