<?php
ob_start();
?>
<?php session_start();?>
<!DOCTYPE html>
<html lang="es">
 <head>
 <meta charset="UTF-8">
 <title>WEB CORPORATIVA - DAMU</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
<!--boostrap--> <!--/* Incluye menú responsivo-->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 

<!-- REJILLA -->
<link href=" https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/cerulean/bootstrap.min.css"  rel="stylesheet" integrity="sha256-Ucf/ylcKTNevYP6l7VNUhGLDRZPQs1+LsbbxuzMxUJM=  sha512-FW2XqnqMwERwg0LplG7D64h8zA1BsxvxrDseWpHLq8Dg8kOBmLs19XNa9oAajN/ToJRRklfDJ398sOU+7LcjZA=="  crossorigin="anonymous">
<script  src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"  type="text/javascript"></script>
<!-- REJILLA documentos -->


 <!--Iconos redes sociales-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- Enlace hoja estilos -->
  <!-- <link rel="stylesheet" type="text/css" href="recursos/estilos.css">-->
 <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
 <!--FAVICON-->
 <link rel="icon" href="recursos/favi.png" type="image/png" sizes="16x16">

 <!--css-->
 <STYLE TYPE='text/css'>
/* CSS generated at csscreator.com */

* {
  box-sizing: border-box;
}

html, body{ 
 margin:0; 
 padding:0; 
 background-color:#D6EC8F; 
 } 
 
#pagewidth{ }
 
#maincol{
 background-color: #D6EC8F;  
 position: relative; 
 }
 
#footer{
 height:150px; 
  background-color:#515760; 
 clear:both;
 display:block;
 overflow:auto;
} 
 


.clearfix:after {
 content: "."; 
 display: block; 
height: 0; 
 clear: both; 
 visibility: hidden;
 }
 
.clearfix{display: inline-block;}

/* Hides from IE-mac \*/
* html .clearfix{height: 1%;}
.clearfix{display: block;}
/* End hide from IE-mac */ 
/*P{ font-family:sans-serif; background-color:#665744; }*/
PRE{ font-family:sans-serif; background-color:#D6EC8F; }
TABLE{background-color:#69C16F; }
TR{background-color:#D6EC8F; color:black;}
TD{color:;}
HEADER {background-color:#515760;}
SELECT{color:#81bda4; }
</STYLE>
 </head>
 <body>
     <div class="paginaweb">
 
 <?php    
  include "utilidades/utilidades.php";
   /* echo "<pre>";  */       
    //Depurar($_SESSION);
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
   // print_r($_SESSION); //Comprobar que se ha iniciado sesion

    if(array_key_exists('iniciada', $_SESSION)
      && $_SESSION['iniciada'] == true )     
    {
      if( $_SESSION['nombre'] == 'Administrador'){
        echo "Hola, Administrador";
        echo "<br>";
        echo "<center>"."<a href=\"acciones/administrador.php\">Ir a página del administrador</a>"."</center>";
        //header("location: acciones/administrador.php");
      }else if($_SESSION['nombre'] != 'Administrador'){
        echo "<br>";
        echo "<p>Hola, usuario: ".$_SESSION['nombre']."</p>";
        echo "<br>";
        echo "<center>";
          echo "<a href=\"acciones/usuarios.php\">Ir a mi página</a>";
          echo "<br>";
          echo "<a href=\"acciones/logout.php\">Cerrar sesión</a>";
        echo "</center>";
      }
    
    } 

    //
    $conexion = mysqli_connect('db', 'root', 'test', 'myDb') or die("Problemas con la conexión");
    $registros = mysqli_query($conexion, "SELECT nombreuser, img, date_format(fecha,'%d/%m/%Y %H:%i:%s') as fecha2 FROM documentos order by fecha2 desc")
        or die("Problemas en la consulta:".mysqli_error($conexion));
    echo "<table class='table table-striped' style='background-color: white'>";
    echo "<tr><th>Subido por:</th><th>Fecha de subida:</th>";
    while ($reg = mysqli_fetch_array($registros)) {
      $img = $reg['img'];
        echo "<tr>";
            echo "<td>" . $reg['nombreuser'] . "</td>";
            echo "<td>" . $reg['fecha2'] . "</td>";
            echo "<td>" . "<img src='recursos/$img' border='0' width='300' height='100'>" . "</td>";
        echo "</tr>";
       
    }
    ?>
    <!--buscador-->
    <form id="buscador" name="buscador" method="post" action="buscador.php">
    <input id="buscar" name="buscar" type="search" placeholder="Buscar aquí…" autofocus > 
    <input type="submit" name="buscador" class="boton peque aceptar" value="buscar"> </form>
    <?php
    echo "</table>";
    echo "</pre>";
      
    mysqli_close($conexion);

    ?>


<?php
    
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
</div>
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
  </div>
  </footer>
<script type="text/javascript" src="recursos/js.js"></script>
 </body>
</html>
<?php
ob_end_flush();
?>

