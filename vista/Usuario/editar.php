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

    $datosUsuario = ['Id'=>$IdElemento];
    $objUsuario = new Entidad($datosUsuario);
    $objControlUsuario = new ControlEntidad($TableName);
    $objUsuario = $objControlUsuario->buscarPorId('Id',$IdElemento);

   
      
      $objControlRolUsuario = new ControlEntidad('rol_usuario');
      $sql = "SELECT rol.Id as Id, rol.Name as Name
          FROM rol_usuario INNER JOIN rol ON rol_usuario.FkIdRol = rol.Id
          WHERE FkIdUsuario = ?";
      $parametros = [$IdElemento];
      $arregloRolesConsulta = $objControlRolUsuario->consultar($sql, $parametros); 
       // Validar si $objUsuario es nulo antes de acceder a sus propiedades
      $arrayRoles = [];
      for($i=0; $i<count($arregloRolesConsulta); $i++){
        $arrayRoles[$i] = $arregloRolesConsulta[$i]->__get('Id') . ';' . $arregloRolesConsulta[$i]->__get('Name');
      }
    if ($objUsuario !== null) {
      $datos = [
        'Email' => $objUsuario->__get('Email'),
        'Name' => $objUsuario->__get('Name'),
        //'Password' => $objUsuario->__get('Password'),      
        'Roles' => $arrayRoles     
      ];
      
      // Convertir el array a formato JSON
      $jsonResponse = json_encode($datos);
      // Devolver la respuesta JSON
      echo $jsonResponse;
    } else {
      // Manejar el caso en que $objUsuario es nulo
      echo json_encode(['error' => 'El rol no se encontró.']);
    }
    //var_dump($jsonResponse);
    
  } 
  
?>

