<!DOCTYPE html>
<html lang="es">
 <head>
 <meta charset="UTF-8">
 <title>Inicio de sesión</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">

<!--Iconos redes sociales-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
<!--FAVICON-->
 <link rel="icon" href="../recursos/favi.png" type="image/png" sizes="16x16">
<!-- css-->

 <link rel="stylesheet" href="../recursos/estilos.css" type="text/css">

</head>
 <body>
   <div class="paginaweb text-center">
   <div id="pagewidth">
<div id="wrapper" class="clearfix">
  <div id="maincol" text-align="center">
      <h1>Por favor inicie sesión:</h1> <img src="../recursos/logo.png" width="40" height="40" title="logo_empresa" alt="logo"/> 
 
<!-- class="form-control" -->
      <form class="form-inline" method="post" class="login-form" action="../acciones/login.php"> 
        <div class="input-group">           
          <label for="correo"> Correo electrónico: </label> <input type="email" class="form-control" placeholder="Introduce email" name="email" required="true">
          <br>
          <label for="contra">Contraseña: </label> <input type="password" class="form-control" name="contraseña" placeholder="Introduce Contraseña" required="true">
          <br>
            <div class="input-group-btn">
              <button type="submit" class="btn btn-danger" value="Iniciar" name="iniciar" >Iniciar Sesión </button>  
            </div>
       </form>
        </div>
</div>
</div>
      </div>
 <?php    
    echo "<pre>";
     //validacion formulario???   
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

