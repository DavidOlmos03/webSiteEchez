<?php
if (isset($_GET['Name']) && isset($_GET['Description'])) {
    include '../../controlador/configBd.php';
    include '../../controlador/ControlEntidad.php';
    include '../../controlador/ControlConexionPdo.php';
    include '../../modelo/Entidad.php';
    // Obtener los datos del formulario
    $Name = $_GET['Name'];
    $Description = $_GET['Description'];
    

    $datosRol = ['Name' => $Name, 'Description' => $Description];
    $objRol = new Entidad($datosRol);
    $objControlRol = new ControlEntidad('Rol');
    $objControlRol->guardar($objRol);
    
    // Enviar una respuesta JSON al cliente
   // echo json_encode(['success' => true]);
    exit; 
}
?>