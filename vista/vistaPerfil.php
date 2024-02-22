<?php
ob_start();
?>
<?php 
    include '../controlador/configBd.php';	
    include '../controlador/ControlEntidad.php';
    include '../controlador/ControlConexionPdo.php';
    include '../modelo/Entidad.php';
    /**
     * Se inicia la sesion con las variables creadas en el login
     */
    session_start();
    $listaRolesDelUsuario = $_SESSION['listaRolesDelUsuario'];
    $arregloRoles = $_SESSION['arregloRoles'];
    /**
     * Se decide si se da acceso al usuario
     */
    if($_SESSION['email']==null)header('Location: ../login.php');
    
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
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Perfil</title>
<link rel="shortcut icon" href="../vista/img/logo-DBD-01.png">
<!--
    Estilos 
-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" id="bootstrap-css">
<link rel="stylesheet" href="../vista/css/misCss1.css">
<link rel="stylesheet" href="../vista/css/vistaPerfil.css">
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
                <?php if($navbar==0){
                    require('./navbar.php');
                } else if ($navbar==1) {require('./navbar_admin.php');}
                ?>
        </div>

        <div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="../vista/img/avatar_hombre.png" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        <?php echo $_SESSION['Name'];?>
                                    </h5>
                                    <h6>
                                        Web Developer and Designer
                                    </h6>
                                    <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active about-text" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link roles-text" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Roles</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">                          
                            <p class="pages-text">Páginas de interés</p>
                            <a href="">Web Designer</a><br/>
                            <a href="">Web Developer</a><br/>
                            <a href="">WordPress</a><br/>
                            <a href="">WooCommerce</a><br/>
                            <a href="">PHP, .Net</a><br/>
                            <p class="social-text">Redes sociales Echez</p>
                            <a href="https://www.linkedin.com/company/echez-inc-">Linkedin</a><br>
                            <a href="https://es-la.facebook.com/EchezGroup/">Facebook</a><br>
                            <a href="https://twitter.com/EchezGroup">Twitter</a><br>
                            <a href="https://www.instagram.com/echezgroup/">Instagram</a><br>
                            <a href="https://www.youtube.com/channel/UCO3QPwZcCmkCgGlfI3IqKdw">YouTube</a><br>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">                                       
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="name-text">Nombre</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $_SESSION['Name'];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="email-text">Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $_SESSION['email'];?></p>
                                            </div>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="activeRoles-text">Roles activos</label>
                                            </div>                                                                   
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="name-text">Nombre</label>
                                            </div>     
                                            <div class="col-md-6">
                                                <label class="description-text">Descripción</label>
                                            </div>                                       
                                        </div>
                                        
                                        <?php                                        
                                        for($i=0;$i<count($listaRolesDelUsuario);$i++){?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><?php echo $listaRolesDelUsuario[$i]->__get('name');?></p>
                                            </div>
                                            <div class="col-md-6">
                                            <!--
                                                Se aplica la logica para asignar valores de traducción a los roles activos del usuario
                                            -->
                                                <?php switch($listaRolesDelUsuario[$i]->__get('name')){
                                                    case 'Admin-Global':$description = "descriptionAdminGlobal-text";
                                                        break;
                                                    case 'Admin': $description = "descriptionAdmin-text";
                                                        break;
                                                    case 'IT Project': $description = "descriptionITProject-text";
                                                        break;
                                                    case 'Analytics Project': $description = "descriptionAnalytics-text";
                                                        break;
                                                    case 'Inventory': $description = "descriptionInventory-text";
                                                        break;
                                                    case 'Approvals': $description = "descriptionApprovals-text";
                                                        break;}?>

                                                
                                                <p id="<?php echo $description; ?>"><?php echo $listaRolesDelUsuario[$i]->__get('description');?></p>
                                            </div>
                                        </div>
                                        <?php }?>
                                        
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">                                       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="inactiveRoles-text">Roles inactivos</label>
                                            </div>                                               
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="name-text">Nombre</label>
                                            </div>     
                                            <div class="col-md-6">
                                                <label class="description-text">Descripción</label>
                                            </div> 
                                        </div>
                                        <?php                                        
                                        for($i=0;$i<count($arregloRoles);$i++){
                                            $encontrado = false;
                                            for($j=0;$j<count($listaRolesDelUsuario);$j++){
                                                if($arregloRoles[$i]->__get('Name')==$listaRolesDelUsuario[$j]->__get('name')){
                                                    $encontrado = true;                                             
                                                    break;                                                                                
                                                }
                                            }if(!$encontrado){?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p><?php echo $arregloRoles[$i]->__get('Name');?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php switch($arregloRoles[$i]->__get('Name')){
                                                        case 'Admin-Global':$description = "descriptionAdminGlobal-text";
                                                            break;
                                                        case 'Admin': $description = "descriptionAdmin-text";
                                                            break;
                                                        case 'IT Project': $description = "descriptionITProject-text";
                                                            break;
                                                        case 'Analytics Project': $description = "descriptionAnalytics-text";
                                                            break;
                                                        case 'Inventory': $description = "descriptionInventory-text";
                                                            break;
                                                        case 'Approvals': $description = "descriptionApprovals-text";
                                                            break;}?>
                                                        <p id="<?php echo $description; ?>"><?php echo $arregloRoles[$i]->__get('Description');?></p>
                                                    </div>
                                                </div>
                                       <?php }
                                       }?>
                                                                                                                               
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Your Bio</label><br/>
                                        <p>Your detail description</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
                    
    <!--Se agrega un footer al final de la pagina-->
    <div class="footer">
        <?php require('./footer.php') ?>
    </div>

</body>
</html>