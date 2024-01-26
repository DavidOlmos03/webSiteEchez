
<?php
    ob_start();
?>
<?php
	include 'controlador/configBd.php';
    include_once 'controlador/ControlEntidad.php';
    include_once 'controlador/ControlConexionPdo.php';	
    include_once 'modelo/Entidad.php';
    session_start();
	$boton = "";
    $Id = "";
	$Email = "";
	$Password = "";
    $Name = "";
    $propiedades = [];
	
	if (isset($_POST['bt'])) $boton = $_POST['bt'];//toma del arreglo post el value del bt	
	if (isset($_POST['txtEmail'])) $Email = $_POST['txtEmail'];
	if (isset($_POST['txtContrasena'])) $Password = $_POST['txtContrasena'];
	switch ($boton) {
		case 'Login':
            /*
                se inicia el validar en false y luego se hace la consulta sql, la cual espera el valor de
                email
            */
            $validar = false;
            $sql = "SELECT * FROM usuario WHERE email=?";
            /**
             * Se crea entidad de la tabla usuario
             */
            $objControlEntidad = new ControlEntidad('usuario');
            /**
             * Se realiza la consulta utilizando el sql y el valor de $Email proporcionado
             */
            $objUsuario= $objControlEntidad->consultar($sql,[$Email]);           			
            if($objUsuario){
                //$fila = $objUsuario->fetch_assoc();//fetch_assoc se utiliza para objetos de consultas mysql no en arrays
                /**
                 * Se obtiene el hash de la contraseña y se verifica por medio de password_verify de Bcrypt
                 */
                $hash = $objUsuario[0]->__get('Password');               
                $verificar_hash = password_verify($Password, $hash); 
                /**
                 * Se procede a verificar si la contraseña ingresada es correcta o no, en caso de ser correcta
                 * creara las   $_SESSION['email'], $_SESSION['Name'], $_SESSION['arregloRoles'] y  $_SESSION['listaRolesDelUsuario']
                 * para ser utilizadas posteriormente, además de dar ingreso al usuario
                 * */                   
                if ($verificar_hash) {
                    $validar = true;
                    $_SESSION['email']=$Email;
                    $_SESSION['Name']=$objUsuario[0]->__get('Name');
                        $objControlRolUsuario = new ControlEntidad('rol_usuario');

                        $sql = "SELECT rol.id as id, rol.name as name, rol.description
                            FROM rol_usuario INNER JOIN rol ON rol_usuario.fkidrol = rol.id
                            INNER JOIN usuario ON rol_usuario.fkidUsuario = usuario.id
                            WHERE Email = ?";

                        $objControlRol = new ControlEntidad('rol');
                        $arregloRoles = $objControlRol->listar();

                        $parametros = [$Email];
                        
                        $listaRolesDelUsuario = $objControlRolUsuario->consultar($sql, $parametros);
                        //$listaRoles = $objControlRolUsuario->consultar($sql2);


                        $_SESSION['arregloRoles']=$arregloRoles;
                        $_SESSION['listaRolesDelUsuario']=$listaRolesDelUsuario;
                        /**
                         * Redirige a vistaHome 
                         */
                        header('Location: vista/vistaHome.php'); 
                }else{
                    $_SESSION['msj'] = 'Verifique los datos ingresados';
                }           	
            }			         
			break;
		
		default:
			# code...
			break;            
	}
?>




<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<!--author:starttemplate-->
<!--reference site : starttemplate.com-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords"
            content="unique login form,leamug login form,boostrap login form,responsive login form,free css html login form,download login form">
        <meta name="author" content="leamug">
        <title>Echez Group</title>
        <link rel="shortcut icon" href="./vista/img/logo-DBD-01.png"/>
        <link rel="stylesheet" href="vista/css/login.css">
        <!-- Bootstrap core Library -->
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
        <!-- Font Awesome-->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    </head>
    <body>
    
    <!-- Page Content -->
    <div class="container">
        <?php if(isset($_SESSION['msj'])){
            $answer = $_SESSION['msj'];
        ?>
            <script>
                //console.log(<?php echo json_encode($answer); ?>);
                Swal.fire({
                    icon: "error",
                    title: "Datos erroneos...",
                    text: "<?php echo $answer;?>"              
                });
            </script>
        
        <?php session_destroy();} ?>
        <div class="row">           
            <div class="logo col-md-6">
                <img src="./vista/img/Logo-Vertical.png">
            </div>
            <div class="login col-md-6 text-center">
                <h1 class='text-white'>Echez Group</h1>
                <div class="form-login"></br>
                    <h4>Secure Login</h4>
                    </br>
                    <form action="login.php" method="post">
                        <input type="text" id="userName" name="txtEmail" required="required" value="<?php echo $Email ?>" class="form-control input-sm chat-input" placeholder="username"/>
                        </br></br>
                        <input type="password" id="userPassword" name="txtContrasena" required="required" value="<?php echo $Password ?>" class="form-control input-sm chat-input" placeholder="password"/>
                        </br></br>                     
                        <div class="form-group">
                            <button type="submit" name='bt' class="btn btn-primary btn-md login-btn" value="Login">Login<i class="fa fa-sign-in"></i></button>
                        </div>
                        <div class="modal-footer">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        </br></br></br>
        
    </div>
    </body>
</html>
