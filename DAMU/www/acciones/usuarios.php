<?php session_start();?>
<?php
ob_start();?>
<!DOCTYPE html>
<html lang="es">
 <head>
   <meta charset="UTF-8">
   <title>PAGINA DE USUARIO REGISTRADO</title>
   <!--Iconos redes sociales-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- Enlace hoja estilos -->
   <link rel="stylesheet" type="text/css" href="../recursos/estilos.css"> 
   <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
   <!--FAVICON-->
   <link rel="icon" href="../recursos/favi.png" type="image/png" sizes="16x16">
   <style>
      .paginaweb {
        text-align : center; 
        * {
  box-sizing: border-box;
}

html, body{ 
 margin:0; 
 padding:0; 
 background-color:#F6F7BE; 
 } 
 
#pagewidth{ }
 
#maincol{
 background-color: #FFFFFF;  
 position: relative; 
 }
 
#footer{
 height:150px; 
  background-color:#4f675c; 
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
PRE{ font-family:sans-serif; background-color:#F6F7BE; }
TABLE{background-color:#F6F7BE; }
TR{background-color:#e6ac27; color:#665744;}
TD{color:;}
HEADER {background-color:#81bda4;}
SELECT{color:#81bda4; }
</STYLE>
     </head>
 <body>
 <header>

<nav class="navbar navbar-default navbar-fixed-top">
<div class="container">
   <div class="navbar-header">
<img src="../recursos/logo.png" width="100" height="100" title="logo_empresa" alt="logo"/>
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
 </div>
</div>
<div class="collapse navbar-collapse" id="myNavbar">
<ul class="nav navbar-nav navbar-right">
        <li id="Inicio"><a href="../index.php"><span>Inicio</span></a></li>
   </ul>
   </div> 
 </nav>

   </header>
   <div class="paginaweb">
      <h1> Página de Usuario </h1>
      <?php 
         echo "<h3>Bienvenida,".$_SESSION['nombre']."</h3>";
         echo "<br>";
         include "../utilidades/mysql.php";
         include "../utilidades/utilidades.php";
      ?>

<!--Subir archivo-->
<div class="paginaweb text-center">
   <div id="pagewidth">
<div id="wrapper" class="clearfix">
  <div id="maincol" text-align="center">

      <form action="usuarios.php" method="POST" class="login-form" class="form-inline" enctype="multipart/form-data"/>
      <div class="input-group">  
         <label for="nomina"> Añadir nómina o contrato: </label> <input name="archivo" id="archivo" type="file"/>
   <!--   <label for="tipod"> Indique tipo de documento (nomina/contrato): </label> <input name="tipod" id="tipod" type="text"/>
         <label for="fechad"> Indique fecha (aa/mm/dd): </label> <input name="fechad" id="fechad" type="text"/>
         <div class="input-group-btn">-->
         <input type="submit" name="subir" value="Subir imagen"/>
   </div>
      </form>
   </div>
   </div>
   </div>
   </div>
      <?php
         $autor = $_SESSION['nombre'];
         //Si se quiere subir una imagen
         if (isset($_POST['subir'])) {
         //Recogemos el archivo enviado por el formulario
            getdate();
            $archivo = $_FILES['archivo']['name'];

         //Si el archivo contiene algo y es diferente de vacio
            if (isset($archivo) && $archivo != "") {
         //Obtenemos algunos datos necesarios sobre el archivo
            $tipo = $_FILES['archivo']['type'];
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];
            $fecha = date("Y-m-d,H:i:s"); //fecha de hoy formateada
           // $fecha2 = $_POST['fechad'];
            //$tipo2 = $_POST['tipod'];

      //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño. Y se sube
      if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
         echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
         - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
      } else {
         $ruta = "$autor/$archivo";

     if (move_uploaded_file($temp, '../recursos/'. $autor . '/' .$archivo)) {
         //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
         chmod('../recursos/'. $autor . '/' .$archivo, 0777);
         //Mostramos el mensaje de que se ha subido co éxito
         echo '<div><b>Se ha subido correctamente el documento.</b></div>';
     //    rename("../recursos/$autor/$archivo", "../recursos/$autor/$archivo-$autor.png");
         //Mostramos imagen
         echo "<img src='../recursos/$autor/$archivo' border='0' width='300' height='100'>";
         //Creamos el registro en la tabla documentos
     
 
         //Depurar($_POST);
 
       //  $nombre = $_POST['archivo']; Daba un error de indefinido archivo y parece que comentandolo sigue funcionando
       
         $conexion = Conectar($configuración['bbdd']);
     
      //  Depurar($conexion);

            // AÑADIMOS RUTA DEL ARCHIVO PARA MOSTRAR EN REJILLA. MODIFICAR IDUSUARIO
               $sql =  "insert into documentos(fecha, img, nombreuser, nombredocu) values('". $fecha . "','" . "../recursos/$ruta" . "', '" . $autor . "', '" . $archivo . "')";
            // $sql =  "insert into documentos(fecha, img, nombreuser) values('". $fecha . "', '". $fecha2 . "','" . "../recursos/$ruta" . "', '" . $autor . "')";

            $resultado = Actualizar($conexion,$sql);

           //Depurar($sql);
            //Depurar($resultado);
        }
        else {
           //Si no se ha podido subir la imagen, mostramos un mensaje de error
           echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
        }
      }
   }
}

//fin subir dicumnento.

//Inicio BORRAR documentos
   echo "<h4> Borrar documento </h4>";
   /*echo "<form method='post' action='usuarios.php'>";         
   echo "<br>"; 
   echo "Escribe tu Contraseña:  <input type='password' name='contraseña' required='true'>";
   echo "<br>";
   echo "<input type='submit' value='Mostrar documentos' name='mostrardocumentos'>";
   echo "</form>"; */


   $conexion = mysqli_connect('db', 'root', 'test', 'myDb') or die("Problemas con la conexion");

     
      //Ejecución de la consulta
      $consulta = mysqli_query($conexion, "SELECT * FROM documentos WHERE nombreuser ='".$autor."'");
     // $registros = mysqli_fetch_array($consulta);
      //$campo = $registros['campo'];
   

//Si hay resultados…
//if (isset($_POST['contraseña'])){
         if(mysqli_num_rows($consulta) > 0){
      // Se recoge el número de resultados

            $registros = '<p>HEMOS ENCONTRADO ' . mysqli_num_rows($consulta) . ' registros </p>';
         // Se almacenan las cadenas de resultado
            echo "<center>";
               echo "<table border='2'>";
                  echo "<thead>";
                     echo "<tr><th>id</th><th>Foto:</th><th>Eliminar</th>";
                  echo "</thead>";
                  echo "</tbody>";
                     while($fila = mysqli_fetch_assoc($consulta)){
                        $img = $fila['img'];
                        echo "<tr>";
                        echo "<td>" . $fila['id'] . "</td>";
                        echo "<td>" . "<img src='$img' border='0' width='300' height='100'>" . "</td>";
                        echo "<th>"; ?><a href="borrar2.php?id=<?php echo $fila['id']; ?> "> Eliminar</a></th> 
                        <?php echo "</th>";
                     }
                  echo "</tbody>";
               echo "</table>";
            echo "</center>";
//Si no tiene foto subida, no saldrá ninguna consulta.
      }else{ 
     //    print_r($autor)
  //javascript
      ?><script language='javascript'>
         alert('No tienes ningun documento subido, sube uno!');
        document.write('No hay documentos subidas');
         //window.location.href='usuarios.php';
      </script>
      <?php
   
 /*  }else{

      //javascript
      ?><script language='javascript'>
         alert('La contraseña no coincide con el usuario');
         //window.location.href='usuarios.php';
      </script>
     */ 
    // <?php
            
   //}
   }
      mysqli_close($conexion);
 
   


//CAMBIAR CONTRASEÑA

   echo "<h4> Modificar usuario </h4>";
   echo "<form method='post' action='../acciones/usuarios.php'>";
   echo "<br/>";
   echo "Contraseña:  <input type='password' name='contraseña' required='true'>";
   echo "<br>";
   echo "Contraseña nueva :  <input type='password' name='contraseña2' required='true'>";
   echo "<br/>";
   echo "<input type='submit' value='Modificar contraseña' name='modifc'>";  
   echo "</form>";
  

if (isset($_POST['contraseña']) && isset($_POST['contraseña2'])){
   $conexion = Conectar($configuración['bbdd']);
   
   $contraseña = md5($_POST['contraseña']);
   $contraseñanueva = md5($_POST['contraseña2']);
   $consulta = mysqli_query($conexion, "SELECT * FROM users WHERE contraseña='$contraseña'");
   $registros = mysqli_fetch_array($consulta);
   $compruebapass = $registros['contraseña'];
   
   if($contraseña!=$contraseñanueva){
      
      if($compruebapass == $contraseña){
     // Depurar($conexion);
      $sql =  "UPDATE users SET contraseña='$contraseñanueva' WHERE nombre='$autor'";
      $resultado = Actualizar($conexion,$sql);

      //Contraseña actualizada
      ?> <script language='javascript'>
         alert('Contraseña cambiada correctamente');
         //window.location.href='usuarios.php';
      </script>
      <?php

      echo "<br>";
   }else{
      //javascript
      ?>
      <script language='javascript'>
         alert('La contraseña es incorrecta o la contraseña nueva no puede ser igual a la contraseña antigua');
         //window.location.href='usuarios.php';
      </script>
      <?php
      }
   }
}
//FIN MODIFICAR CONTRASEÑA 

   echo "<br>";
    echo "<a href=\"../index.php\">Volver al inicio</a>";
    echo "</br>";
    echo "<a href=\"logout.php\">Cerrar sesión</a>";

   ?>
</div>
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
</body>
</html>
<?php
ob_end_flush();
?>
