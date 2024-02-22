<?php
if (isset($_GET['User_Name']) && isset($_GET['Serial']) && isset($_GET['PC_Name']) && isset($_GET['Installation_Date']) && isset($_GET['Plate_PC'])
&& isset($_GET['Specifications']) && isset($_GET['Ram']) && isset($_GET['Desktop_Laptop']) && isset($_GET['Domain']) && isset($_GET['Status_PC']) && isset($_GET['dateUpdate_Date'])) {
    include '../../controlador/configBd.php';
    include '../../controlador/ControlEntidad.php';
    include '../../controlador/ControlConexionPdo.php';
    include '../../modelo/Entidad.php';
    /**
     *Obtener los datos del formulario
     */ 
    $User_Name = $_GET['User_Name'];
    $Serial = $_GET['Serial'];
    $PC_Name = $_GET['PC_Name'];
    $Installation_Date = $_GET['Installation_Date'];
    $Plate_PC = $_GET['Plate_PC'];
    $Specifications = $_GET['Specifications'];
    $Ram = $_GET['Ram'];
    $Desktop_Laptop = $_GET['Desktop_Laptop'];
    $Domain = $_GET['Domain'];
    $Status_PC = $_GET['Status_PC'];
    $dateUpdate_Date = $_GET['dateUpdate_Date'];
    
    /**
     * Se procede a guardar los datos
     */
    $datosAlquilado = ['User_Name'=> $User_Name,'Serial'=> $Serial,'PC_Name'=> $PC_Name,'Installation_Date'=> $Installation_Date,'Plate_PC'=> $Plate_PC,'Specifications'=> $Specifications,
	        'Ram'=>$Ram,'Desktop_Laptop'=> $Desktop_Laptop,'Domain'=> $Domain,'Status_PC'=> $Status_PC,'dateUpdate_Date'=> $dateUpdate_Date];
			$objAlquilado = new Entidad($datosAlquilado);
			$objControlAlquilado = new ControlEntidad('Alquilado');
			$objControlAlquilado->guardar($objAlquilado);
		
    exit; 
}
?>