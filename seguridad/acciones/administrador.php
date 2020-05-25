<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
 <head>
 <meta charset="UTF-8">
 <title>Configuración Administrador</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
<!--boostrap-->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
 <!--Iconos redes sociales-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- Enlace hoja estilos -->
   <link rel="stylesheet" type="text/css" href="../recursos/estilos.css">
 <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
 <!--FAVICON-->
 <link rel="icon" href="../recursos/favi.png" type="image/png" sizes="16x16">
 </head>
 <body>
<div class="paginaweb">
<h1>Página del Administrador</h2>
<br/>

<!--pagina de administrador--> 
<?php
include "../utilidades/mysql.php";
Mostrarusu();
echo "<center>"."<a href=\"formadministrador.php\">Configuración del administrador</a>"."</center>";
echo "<br>";
echo "<a href=\"../index.php\">Volver a inicio</a>";
echo "<br>";
echo "<a href=\"logout.php\">Cerrar sesión</a>";
?>
<header>
<nav class="navbar navbar-default navbar-fixed-top">
<div class="container">
   <div class="navbar-header">
<img src="recursos/logo.png" width="100" height="100" title="logo_empresa" alt="logo"/>
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	   <span class="icon-bar"></span>
	   <span class="icon-bar"></span>
	   <span class="icon-bar"></span>
	 </button>
 </div>
</div>
<div class="collapse navbar-collapse" id="myNavbar">
<ul class="nav navbar-nav navbar-right">
		   <li id="Inicio"><a href="#slide"><span>Inicio</span></a></li>
		   <li id="login" ><a href="acciones/formIniciosesion.php"> <span>Inicia Sesión</span></a></li>
		   <li id="login" ><a href="acciones/formRegistro.php"> <span>Registrate Gratis</span></a></li>
   </ul>
   </div> 
 </nav>

   </header>
</div>
<footer>
<h3> SIGUENOS EN REDES SOCIALES </h3>
	<div class="sociales">
	    <a target="_blank" href="https://www.facebook.com/"><i class="fa fa-facebook-official" style="font-size:20px;color:#4267B2;float:right;"></i></a>
	  <a target="_blank" href="https://twitter.com/"><i class="fa fa-twitter-square" style="font-size:20px;color:#00BBF2;float:right"></i></a>
	    <a target="_blank" href="https://www.instagram.com/?hl=es"><i class="fa fa-instagram" style="font-size:20px;color:#FD2C80;float:right;"></i></a>
	  <a href="https://www.youtube.com/?gl=ES&hl=es"> <i class="fa fa-youtube-square" style="font-size:20px;color:red;float:right"></i></a>
	</div>
    <img src="recursos/logo.png" width="40" height="40" title="logo_empresa" alt="logo"/>
	<p> NosVemos Company.&copy; 2020. Todos los derechos reservados.
</footer>
</body>
</html>
<?php
ob_end_flush();
?>
