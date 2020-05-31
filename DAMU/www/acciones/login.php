<?php
ob_start();
?>
<?php session_start();?>
﻿<!DOCTYPE html>
 <head>
 <meta charset="UTF-8">
 <title>Login</title>
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
<?php    
   include "../utilidades/mysql.php";
   include "../utilidades/utilidades.php";
 
    echo "<pre>";          
    //print_r($_POST);
 
    $correo = $_POST['email'];
    $contraseña = md5($_POST['contraseña']);
    $conexión = Conectar($configuración['bbdd']);
 
    //Depurar($conexión);
    //COMPROBAR SI USUARIO ES CORRECTO
    $sql =  "select * from users where email = '".$correo."' and contraseña = '".$contraseña."'";
  
    //Depurar($sql);
    $datos = Consultar($conexión,$sql);
 
    //Depurar($datos);
    if($datos != null)
    {
      $_SESSION['iniciada'] = true;
      $_SESSION['nombre'] = $datos[0]['nombre'];
      //Depurar($_SESSION);
      Desconectar($conexión);
      //PRUEBA PARA Q ME LLEVE DIRECTAMENTE A USUARIO O ADMJNISTRADOR SIN PASAR X INDEX
      if( $_SESSION['nombre'] == 'Administrador')
      {
        echo "<br>";
        header("location: ../index.php");
      }else{
        header("location: ../index.php");
      }
    }
    //si coUNT ES MENOR a 0, es que no se ha podido conectar, usuario incorrecto.
    else
    {
      session_start();
      $_SESSION['iniciada'] = false;
       // Gestionar usuario o contraseña no válida. Que me lleve de nuevo a login.
?> <script language='javascript'>
       alert('Error en contraseña o email. Inténtalo de nuevo.');
       window.location.href='formIniciosesion.php';
       </script>; 
<?php
       // echo "<a href=\"formIniciosesion.php\">Volver a intentar</a>";
  
    }
    //SI ME LLEVA DIRECTAMENT ENO TIENE Q IR A INDEX.
    //Header("location: ../index.php");
    //echo "</pre>";
?>
 </body>
</html>

<?php
ob_end_flush();
?>
