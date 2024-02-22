<?php 
    include '../controlador/configBd.php';	
    include '../controlador/ControlEntidad.php';
    include '../controlador/ControlConexionPdo.php';
    include '../modelo/Entidad.php';
    /**
     * Se inicia la sesion con las variables creadas en el login
     */
  session_start();
  /**
   * Se decide si se da acceso al usuario
   */
  if($_SESSION['email']==null)header('Location: http://localhost/webSiteEchez/login.php');
    /**
     * Se obtiene la lista de roles almacenada desde el login
     */
    $listaRolesDelUsuario = $_SESSION['listaRolesDelUsuario'];
    $navbar = 0;
    $bandera1 = false;
	for($i=0;$i<count($listaRolesDelUsuario);$i++){
        /**
         * Control de Rol, con esto se administran los permisos del usuario y tambien el navbar a mostrar
         */
        if($listaRolesDelUsuario[$i]->__get('name')=="Admin-Global"){
            $navbar=0;
            $bandera1 = true;
            
        }else if($listaRolesDelUsuario[$i]->__get('name')=="Admin" && $bandera1 != true){
			$navbar = 1;
            
		}	
        
	}  
    /**
     * Se crea la sesion para el control del idioma 
     */
    $_SESSION['lang']='en';
    $lang = $_SESSION['lang'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title class="home-text">Home</title>
<link rel="shortcut icon" href="../vista/img/logo-DBD-01.png">

<!--
    Estilos 
-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../vista/css/misCss1.css">
<link rel="stylesheet" href="../vista/css/vistaHome.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!--
    JS
-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/misFunciones.js"></script>
<script src="js/misFunciones2.js"></script>



</head>
<body>
    <!--
        Se seleciona la barra de navegación para mostrar según el rol (Esto puede ser mejorado dando este acceso
        según el rol directamente en navbar.php a cada uno lo los apartados del menú)
    -->	
        <div class="navBar">
                <?php if($navbar == 0){
                    require('./navbar.php');
                } else if($navbar == 1) {require('./navbar_admin.php');}
                ?>
        </div>
       			
        <div class="how-section1">
                    <div class="row">
                        <div class="col-md-12 how-img">
                            <img src="http://localhost/webSiteEchez/vista/img/echez-group.png" class="rounded-circle img-fluid" alt=""/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">                       
                            <h4 id="future-text" style="text-align: center;">De cara al futuro</h4>
                            <p id = "transformation-text"class="subheading" style="text-align: center;">Somos habilitadores de tu transformación digital</p>
                        <p class="text-muted">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 how-img">
                            <img src="../vista/img/fe-100x100.png" class="rounded-circle img-fluid" alt=""/>
                        </div>  
                        <div class="col-md-6 how-img">
                            <img src="../vista/img/teamwork-icon-100x100.png" class="rounded-circle img-fluid" alt=""/>
                        </div>                       
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <h4 id="faithTittle-text">Principio</h4>
                            <p id="faith-text" class="subheading" style="text-align: center;">Realizamos un ejercicio de fe y reconocemos un Ser superior como parte integral del desarrollo humano que nos lleva a alcanzar plenitud y felicidad. 
                                Creemos en que cada uno de nosotros da lo mejor de sí.  Somos socialmente responsables, propendemos un trabajo ético y nos conectamos con problemáticas sociales.</p>
                        </div>
                        <div class="col-md-6">
                            <h4 id="valueTittle-text">Valor</h4>
                            <p id="values-text" class="subheading" style="text-align: center;">Trabajamos de manera colaborativa, como un grupo, entendiendo las necesidades de nuestros clientes para asegurar y exceder los objetivos propuestos.</p>
                        </div>                     
                    </div>                                    
        </div> 
                    
    <!--Se agrega un footer al final de la pagina-->
    <div class="footer">
        <?php require('./footer.php') ?>
    </div>

</body>
</html>