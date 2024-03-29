<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="http://localhost/webSiteEchez/vista/css/navbar.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./vista/js/misFunciones2.js"></script>
  <!--
    Para realizar el cambio de idioma
-->
<script src="http://localhost/webSiteEchez/vista/js/lang.js"></script>
</head>
<body>
<!--Se agrega una barra de navegación para acceder a los CRUDs, y agregar la funcionalidad "buscar"-->
<div class="menu">
<nav class="navbar navbar-expand-lg navbar-light bg-light">


  <img id="echezGroup" src="http://localhost/webSiteEchez/vista/img/Logo-Horizontal.png"></img>
   <!--
            Boton para realizar el cambio de idioma
    -->
    <div class="flagButton">
      <button onclick="changeLanguage('es')"><img id="spanishFlag" src="http://localhost/webSiteEchez/vista/img/es1x1.svg"></img></button>
      <button onclick="changeLanguage('en')"><img id="englishFlag" src="http://localhost/webSiteEchez/vista/img/us1x1.svg"></img></button>
    </div>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="home-text nav-link" href="http://localhost/webSiteEchez/vista/vistaHome.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="profile-text nav-link" href="http://localhost/webSiteEchez/vista/vistaPerfil.php">Perfil <span class="sr-only">(current)</span></a>
      </li>
      
          
      <li class="nav-item dropdown" >
        <a class="inventory-text nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Inventario TI
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="border-radius: 10px">
		    <a class="rented-text dropdown-item" href="http://localhost/webSiteEchez/vista/Alquilado/vistaAlquilado.php">PCs Alquilados</a>
        <a class="licensing-text dropdown-item" href="http://localhost/webSiteEchez/vista/Licenciamiento/vistaLicenciamiento.php">Formulario licenciamiento</a>
          <div class="dropdown-divider"></div>
          <a class="user-text dropdown-item" href="http://localhost/webSiteEchez/vista/Usuario/vistaUsuarios.php">Usuario</a>
          <a class="role-text dropdown-item" href="http://localhost/webSiteEchez/vista/Rol/vistaRol.php">Rol</a>
        </div>
      </li>
      <!--<li class="nav-item exit-button">
        <a class="nav-link" href="http://localhost/webSiteEchez/vista/cerrarSesion.php">Salir</a>
      </li>-->
      <li class="nav-item exit-button">
        <a class="nav-link">
          <button onclick="exitAlert()" class="exit-text">Exit</button>
        </a>
      </li>
    </ul>
    <!--<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Borrar">Search</button> No esta cogiendo el value
    </form>-->
  </div>
</nav>
</div>
