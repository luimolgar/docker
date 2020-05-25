
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Corporativa DAMU</title>
    <!--Iconos redes sociales-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Enlace hoja estilos -->
     <!-- <link rel="stylesheet" type="text/css" href="recursos/estilos.css">-->
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
    <!--FAVICON-->
    <link rel="icon" href="recursos/favi.jpg" type="image/png" sizes="16x16">
   <!--boostrap--> <!--/* Incluye menú responsivo-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <!-- REJILLA -->
   <link href=" https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/cerulean/bootstrap.min.css"  rel="stylesheet" integrity="sha256-Ucf/ylcKTNevYP6l7VNUhGLDRZPQs1+LsbbxuzMxUJM=  sha512-FW2XqnqMwERwg0LplG7D64h8zA1BsxvxrDseWpHLq8Dg8kOBmLs19XNa9oAajN/ToJRRklfDJ398sOU+7LcjZA=="  crossorigin="anonymous">
   <script  src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"  type="text/javascript"></script>


<style>
  * {
    margin: 0;
    padding: 0;
    background-color: #D6ED8C;
  }
 .header {
   background-image: url("recursos/fondo-portada.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    overflow: hidden;
    /* background-color: #f1f1f1; */
    padding: 0px;
 }

 #maincol
 { overflow: hidden;
 /* background-color: #f1f1f1; */
 padding: 0px;
}

#footer{
 height:150px;
  background-color:#69C16F;
 clear:both;
 display:block;
 overflow:auto;
}
/* Style the header links */
.header a {
  float: left;
  color: white;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  line-height: 25px;
  border-radius: 4px;
}

/* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
.header a.logo {
font-size: 25px;
  font-weight: bold;
}

/* Change the background color on mouse-over */
.header a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the active/current link*/
.header a.active {
  background-color: dodgerblue;
  color: white;
}

/* Float the link section to the right */
.header-right {
  float: right;
}

/* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  .header-right {
    float: none;
  }
}

.content {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}

.content div {
  width: 130px;
  height: 130px;
  background: #D6ED8C;
  margin-bottom: 10px;
}

</style>
  </head>
  <body>
    <div class="header">
  <a href="#default" class="logo"><img src="recursos/logo.jpg" alt="logo"></a>
  <div class="header-right">
    <a class="active" href="#home">Inicio</a>
    <a href="#contact">Iniciar sesión</a>
    <a href="#about">Registro</a>
  </div>
  </div>

  <div class="paginaweb">

 <!--buscador-->
 <form id="buscador" name="buscador" method="post" action="buscador.php">
 <input id="buscar" name="buscar" type="search" placeholder="Buscar aquí…" autofocus >
 <input type="submit" name="buscador" class="boton peque aceptar" value="buscar"> </form>

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
         <li id="registro" ><a href="acciones/formRegistro.php"> <span>Registrate Gratis</span></a></li>
 </ul>
 </div>
</nav>

</div>

<!--CONTENIDO DE LA PAGINA-->
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<!--fin estilo principal-->

<!--Pie de pagina-->
<footer id="footer">

<h3> SIGUENOS EN REDES SOCIALES </h3>
<div class="sociales">
   <a target="_blank" href="https://www.facebook.com/"><i class="fa fa-facebook-official" style="font-size:20px;color:#4267B2;float:right;"></i></a>
 <a target="_blank" href="https://twitter.com/"><i class="fa fa-twitter-square" style="font-size:20px;color:#00BBF2;float:right"></i></a>
   <a target="_blank" href="https://www.instagram.com/?hl=es"><i class="fa fa-instagram" style="font-size:20px;color:#FD2C80;float:right;"></i></a>
 <a href="https://www.youtube.com/?gl=ES&hl=es"> <i class="fa fa-youtube-square" style="font-size:20px;color:red;float:right"></i></a>
</div>
 <img src="recursos/logo.png" width="40" height="40" title="logo_empresa" alt="logo"/>
<p> DAMU.&copy; 2020. Todos los derechos reservados.

</footer>
<script type="text/javascript" src="recursos/js.js"></script>
</body>
</html>
