<?php
  if(isset($_GET['Id']) && isset($_GET['TableName'])) {
    $IdElemento = $_GET['Id'];
    $TableName = $_GET['TableName'];
    
    include '../../controlador/configBd.php';
    include '../../controlador/ControlEntidad.php';
    include '../../controlador/ControlConexionPdo.php';
    include '../../modelo/Entidad.php';

    
    /**
     * Por medio del Id recibido del frontend se busca el elemento de la tabla
     */

      $datosAlquilado=['Id' => $IdElemento];
			$objAlquilado = new Entidad($datosAlquilado); 
			$objControlAlquilado = new ControlEntidad($TableName);
			$objAlquilado = $objControlAlquilado->buscarPorId('Id', $IdElemento);
			
			/**
       * Se valida si $objRol es nulo antes de acceder a sus propiedades
       */
			if ($objAlquilado !== null) {
                $datos = [
                    'Id' => $objAlquilado->__get('Id'),
                    'User_Name' => $objAlquilado->__get('User_Name'),
                    'Serial' => $objAlquilado->__get('Serial'),
                    'PC_Name' => $objAlquilado->__get('PC_Name'),
                    'Installation_Date' => $objAlquilado->__get('Installation_Date'),
                    'Plate_PC' => $objAlquilado->__get('Plate_PC'),
                    'Specifications' => $objAlquilado->__get('Specifications'),
                    'Ram' => $objAlquilado->__get('Ram'),
                    'Desktop_Laptop' => $objAlquilado->__get('Desktop_Laptop'),
                    'Domain' => $objAlquilado->__get('Domain'),
                    'Status_PC' => $objAlquilado->__get('Status_PC'),
                    'dateUpdate_Date' => $objAlquilado->__get('dateUpdate_Date')
                ];
        
                /**
                 *  Convertir el array a formato JSON
                 */ 
                $jsonResponse = json_encode($datos);
        
                /**
                 * Devolver la respuesta JSON
                 */
                echo $jsonResponse;
			} else {
				/**
         * Se maneja el caso en que $objRol es nulo
         */
                echo json_encode(['error' => 'El usuario no se encontró.']);
			}          
  } 
  
?>

