<?php
if (isset($_GET['Name']) && isset($_GET['Email']) && isset($_GET['Password'])) {
    include '../../controlador/configBd.php';
    include '../../controlador/ControlEntidad.php';
    include '../../controlador/ControlConexionPdo.php';
    include '../../modelo/Entidad.php';
    // Obtener los datos del formulario
    $Name = $_GET['Name'];
    $Email = $_GET['Email'];
    $Password = $_GET['Password'];
    $listbox1 = json_decode($_GET['listbox1'], true);

    // Hashea la contraseña con Bcrypt
    $hash = password_hash($Password, PASSWORD_BCRYPT);
    $datosUsuario = ['Name'=>$Name,'Email'=>$Email,'Password'=>$hash];
    $objUsuario = new Entidad($datosUsuario);
    $objControlUsuario = new ControlEntidad('usuario');
    $objControlUsuario->guardar($objUsuario);
    if (!empty($listbox1)){
        for($i = 0; $i < count($listbox1); $i++){
            $IdRol = (int) explode(";", $listbox1[$i]['value'])[0];		

            //Se consulta el Id del usuario para poder agregarlo en rol_usuario					                  
            $objUsuario = $objControlUsuario->buscarPorId('email',$Email);
            $Id = (int) $objUsuario->__get('Id');

            $datosRolUsuario = ['FkIdUsuario'=>$Id,'FkIdRol'=>$IdRol];
            $objRolUsuario = new Entidad($datosRolUsuario);

            $objControlRolUsuario = new ControlEntidad('rol_usuario');
            $objControlRolUsuario->guardar($objRolUsuario);
        }
    }
    // Enviar una respuesta JSON al cliente
    var_dump($listbox1);
   // echo json_encode(['success' => true]);
    exit; 
}
?>