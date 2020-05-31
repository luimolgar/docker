<!DOCTYPE html>
<html lang="es">
 <head>
 <meta charset="UTF-8">
 <title>Registro</title>
 </head>
 <body>
 <?php    
   include "../utilidades/mysql.php";
   include "../utilidades/utilidades.php";
    
   //Depurar($_POST);
    
   $nombre = $_POST['nombre'];
   $correo = $_POST['email'];
   $contraseña = md5($_POST['contraseña']);   
   $conexión = Conectar($configuración['bbdd']);
   $carpeta = "../recursos/$nombre/";
   //Depurar($conexión);     

   //****************** Hay que comprobar antes si ya hay un usuario registrado con el mismo nombre o correo */
   /*$sql =  "insert into users(nombre, email, contraseña) values('".
      $nombre . "', '" . $correo . "', '" . $contraseña . "')";
   $resultado = Actualizar($conexión,$sql);
   Depurar($sql);
   Depurar($resultado);*/
  // $enlace = mysql_connect("localhost", "admin", "1234");
   $enlace = mysqli_connect('db', 'root', 'test', 'myDb') or die("Problemas con la conexión");
  // mysql_select_db("myDb", $enlace);
   
   $resultado = mysqli_query($enlace, "SELECT nombre FROM users WHERE nombre = '".$nombre."'");
   $resultado2 = mysqli_query($enlace, "SELECT nombre FROM users WHERE email = '".$correo."'");

   $numero_filas = mysqli_num_rows($resultado);
   $numero_filas2 = mysqli_num_rows($resultado2);

   if($numero_filas == 0 && $numero_filas2 == 0)
   {
    $sql =  "insert into users(nombre, email, contraseña) values('".
    $nombre . "', '" . $correo . "', '" . $contraseña . "')";
    Actualizar($conexión,$sql);
    if(!file_exists($carpeta)) mkdir($carpeta);
    chmod("../recursos/$nombre/", 0755); 
   }
   else
   {
     ?>
       <script language='javascript'>
       alert('El usuario y/o correo ya existe. Intente otro nombre, por favor.');
       window.location.href='formRegistro.php';
       </script>
     </script>
     <?php

     /*
    echo "Usuario ya existe";
    echo "<br>";
    echo "<a href=\"formRegistro.php\">Volver a intentar</a>";
    echo "<br>";
    echo "$numero_filas Número de nombres de usuario repetidos (filas)\n";
    */
   }
   

  // Creamos la carpeta
  if(!file_exists($carpeta)) mkdir($carpeta);
 chmod("../recursos/$nombre/", 0755); 


   Desconectar($conexión);
   //header("location: ../index.php");
?>
   <script language='javascript'>
   alert('Usuario creado correctamente');
   window.location.href='../index.php';
   </script>


 </body>
</html>
