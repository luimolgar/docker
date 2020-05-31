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
 <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
 <link rel="stylesheet" href="../recursos/estilos.css" type="text/css">
<!--FAVICON-->
 
 </head>

 <body>
   <script type="text/javascript">  
      // aquí hay que comprobar que las 2 contaseñas son iguales.  
   </script>

   <h1>Configuración Administrador:</h1>
   <h4> Eliminar usuario </h4>
   <form method="post" action="conf2.php">            
      Nombre de usuario: <input type="text" name="usuarioeliminar" required="true">
      <br>   
      <input type="submit" value="Eliminar" name="delete">
   </form> 
   

   <br/>
   <h4> Modificar usuario </h4>
   <form method="post" action="../acciones/conf2.php"> 
      Nombre de usuario: <input type="text" name="usuario" required="true">
      <br>  
      Repita nombre de usuario: <input type="text" name="usuario2" required="true"> 
      <br/>
      Contraseña:  <input type="password" name="contraseña" required="true">
      <br>
      Contraseña nueva :  <input type="password" name="contraseña2" required="true">
      <br/>
      <input type="submit" value="Modificar contraseña " name="modifc">
   </form>
<!--   borrar foto-->
<!--buscador-->
   <h4> Borrar foto </h4>
   <form method="post" action="conf2.php">            
      Nombre de usuario: <input type="text" name="usuariofoto" required="true">
      <br>   
      <input type="submit" value="Mostrar documentos" name="mostrardocumentos">
   </form> 


<?php 
 
//falta q pueda eliminar documentos??? solo 1.
 //seguro que quieres eliminar el usuario?? javascript.
echo "<br>";
 echo "<a href=\"../index.php\">Volver a inicio</a>";
 echo "<br>";
 echo "<br>";
 echo "<a href=\"logout.php\">Cerrar sesión</a>";

 

    echo "<pre>";


    echo "</pre>";
 ?>
 <a href="../index.php"> <span>Volver al Inicio</span></a>
 </div>


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
