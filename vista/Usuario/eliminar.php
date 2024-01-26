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
    $arrUsuario=['Id' => $idElemento];
    $objUsuario = new Entidad($arrUsuario);
    $objControlUsuario = new ControlEntidad('Usuario');
    $objControlUsuario->borrar('Id', $idElemento);
    //header('Location: vistaRol.php');
  } 
?>