<?php
  /*include '../controlador/configBd.php';
  include '../controlador/ControlEntidad.php';
  include '../controlador/ControlConexionPdo.php';
  include '../modelo/Entidad.php';*/

  if(isset($_GET['Id'])) {
    $idElemento = $_GET['Id'];

    // Realizar las operaciones necesarias para eliminar el elemento
    // Puede ser una operación en la base de datos, por ejemplo
    include '../../controlador/configBd.php';
    include '../../controlador/ControlEntidad.php';
    include '../../controlador/ControlConexionPdo.php';
    include '../../modelo/Entidad.php';

    //echo "Id proporcionado: $idElemento";
    //
    $arrRol=['Id' => $idElemento];
    $objRol = new Entidad($arrRol);
    $objControlRol = new ControlEntidad('Rol');
    $objControlRol->borrar('Id', $idElemento);
    //header('Location: vistaRol.php');
  } 
?>