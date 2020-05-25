<!DOCTYPE html>
<html lang="es">
 <head>
 <meta charset="UTF-8">
 <title>Registro</title>
 <!--Iconos redes sociales-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- Enlace hoja estilos -->
   <link rel="stylesheet" type="text/css" href="../recursos/estilos.css">
 <!--FAVICON-->
 <link rel="icon" href="../recursos/favi.png" type="image/png" sizes="16x16">
 <style>
    .paginaweb {
        text-align : center; 
    } 
</style>

 </head>
 <body> 
 <script type="text/javascript">
 // Comprobación que las 2 contaseñas son iguales. 
        function Valida(formulario)
        {
            // Campos obligatorios:
          
            if(formulario.nombre.value.length == 0
            || formulario.email.value.length == 0
            || formulario.contraseña.value.length == 0
            || formulario.contraseña2.value.length == 0)
            {
                alert('Hay campos vacios');
                return false;
            }
            
            //Caracteres Especiales
/*
            var expresionespeciales=/^([a-zñ]+[A-Z]+[\s]*)+$/
            if(!expresionespeciales.test(formulario.nombre.value))
            {
                alert('EL nombre de usuario no es válido');
                return false;
            }*/
            
            
         
            //EMAIL
            var expresionemail=/^\w+@\w+(\.\w+)+$/
            if(!expresionemail.test(formulario.email.value))
            {
                alert ('El email no tiene el formato correcto.');
                return false;
            }
      
        
        //CONTRASEÑA

            if (formulario.contraseña2.value != formulario.contraseña.value) {
            alert ('Las contraseñas deben coincidir.');
            return false;
            }
        return true
        }
    </script>


  <div class="paginaweb text-center">
  <div id="pagewidth">
<div id="wrapper" class="clearfix">
  <div id="maincol" text-align="center">
    <h1>Registro de nuevo usuario:</h1>
    <form method="post" name="formulario" class="form-inline" class="login-form" action="../acciones/registro.php" 
    onsubmit="return Valida(this);"> 
    <div class="input-group">            
        <label for="nombre"> Nombre: </label> <input type="text" name="nombre" required="true">
        <br>
        <label for="nombre"> Correo electrónico: </label> <input type="email" name="email" required="true">
        <br>
        <label for="contra"> Contraseña: </label> <input type="password" name="contraseña" required="true">
        <br>
        <label for="contra"> Repita la contraseña: </label> <input type="password" name="contraseña2" required="true">
        <br>   
        <div class="input-group-btn">   
        <input type="submit" class="btn btn-danger" value="Alta nuevo usuario" name="nuevo">
      </div>
      </div>
      </div>
      </div>

    </form>   
  <?php    
      echo "<pre>";
          
      echo "</pre>";
  ?>
  </div>
  <a href="../index.php"> <span>Volver al Inicio</span></a>
    <!--Pie de pagina-->
  <footer>
    <h3> SIGUENOS EN REDES SOCIALES </h3>
    <div class="sociales">
        <a target="_blank" href="https://www.facebook.com/"><i class="fa fa-facebook-official" style="font-size:20px;color:#4267B2;float:right;"></i></a>
      <a target="_blank" href="https://twitter.com/"><i class="fa fa-twitter-square" style="font-size:20px;color:#00BBF2;float:right"></i></a>
        <a target="_blank" href="https://www.instagram.com/?hl=es"><i class="fa fa-instagram" style="font-size:20px;color:#FD2C80;float:right;"></i></a>
      <a href="https://www.youtube.com/?gl=ES&hl=es"> <i class="fa fa-youtube-square" style="font-size:20px;color:red;float:right"></i></a>
    </div>
      <img src="../recursos/logo.png" width="40" height="40" title="logo_empresa" alt="logo"/>
    <p> DAMU.&copy; 2020. Todos los derechos reservados.
  </footer>
  <script type="text/javascript" src="recursos/js.js"></script>
 </body>
</html>
