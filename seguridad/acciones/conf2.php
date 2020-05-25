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
   
   if (isset($_POST['usuarioeliminar'])) { // <= false

      // No está vacía (true)

   //if ($_POST['accion'] == 'Eliminar') {
	

      //Depurar($_POST);
      
      $conexión = Conectar($configuración['bbdd']);
      $nombre = $_POST['usuarioeliminar'];
      $carpeta = "../recursos/$nombre/";
      //esta variable dentro del if para que no salga indefinida $usuariofoto = $_POST['usuariofoto'];
      //Depurar($conexión);

      /*//si el usuario no existe???*/
      $consulta = mysqli_query($conexión, "SELECT nombre FROM users where nombre = '$nombre'");
      $carpeta = "../recursos/$nombre/";
      $numero_filas = mysqli_num_rows($consulta);
      if ( $numero_filas > 0) 
      {
      $sql =  "DELETE FROM users WHERE nombre = '$nombre'";
      $resultado = Actualizar($conexión,$sql);
      //Depurar($sql);
      //Depurar($resultado);
      ?> <script language='javascript'>
      alert('Se ha eliminado el usuario'); //no se puede poner $nombre no pilla la variable porque es javascript
      window.location.href='formadministrador.php';
      </script>; 
      <?php
      echo "Se ha eliminado al usuario $nombre"; //Como hace el alert no hace este echo

      //primero borramos los archivos  y después la carpeta.
      array_map('unlink', glob("$carpeta/*"));
      rmdir($carpeta);
      //Y después las filas de la base de datos.
      $borrarfilas = "DELETE from documentos where nombreuser = '$nombre'";
      $resultado = Actualizar($conexión,$borrarfilas);
      } else {
         ?> <script language='javascript'>
      alert('No se puede borrar, el usuario no existe el usuario');
      window.location.href='formadministrador.php';
      </script>; 
      <?php
            
      }

      Desconectar($conexión);

   } else if (isset($_POST['usuario']) && isset($_POST['usuario2']))  {
      
      //Depurar($_POST);
      $conexión = Conectar($configuración['bbdd']);
      $nombre = $_POST['usuario'];
      $carpeta = "../recursos/$nombre/";
      $contraseña = md5($_POST['contraseña']);
      $contraseñanueva = md5($_POST['contraseña2']);

      $consulta = mysqli_query($conexión, "SELECT * FROM users WHERE contraseña='$contraseña'");
      $registros = mysqli_fetch_array($consulta);
      $compruebapass = $registros['contraseña'];

      //Depurar($conexión);
      if($contraseña!=$contraseñanueva){
         if($compruebapass == $contraseña ){
         $sql =  "UPDATE users SET contraseña='$contraseñanueva' WHERE nombre='$nombre'";
         $resultado = Actualizar($conexión,$sql);
         //Depurar($sql);
         ?> <script language='javascript'>
         alert('Se ha modificado la contraseña del usuario');
         window.location.href='formadministrador.php';
         </script>;
         <?php
         echo "<br>";
   
      }else{
         ?> <script language='javascript'>
         alert('La contraseña es incorrecta o la contraseña nueva es igual a la contraseña actual');
         window.location.href='formadministrador.php';
         </script>;
         <?php
      //Depurar($resultado);
      //Desconectar($conexión);
      }
    }
      
   } else if (isset($_POST['usuariofoto'])) {
      
      $usuariofoto = $_POST['usuariofoto'];
      //si ha rellenado el nombre de usuario para borrar foto, hace el select y vuelve a fornulario administrador??

      //prueba borrar documentos

      //Variable que contendrá el resultado de la búsqueda

      $texto = "";

      //Variable que contendrá el número de resgistros encontrados

      $registros = "»";

      if($_POST){

         $busqueda = trim($_POST['usuariofoto']);

         $entero = 0;

      if (empty($busqueda)){

         $texto = 'Búsqueda sin resultados';

      }else{

         // Si hay información para buscar, abrimos la conexión
         $conexion = mysqli_connect('db', 'root', 'test', 'myDb') or die("Problemas con la conexión");
         //Ejecución de la consulta

         $consulta = mysqli_query($conexion, "SELECT * FROM documentos WHERE nombreuser ='".$busqueda."'");
         
         //Si hay resultados…

   if (mysqli_num_rows($consulta) > 0){

   // Se recoge el número de resultados

      $registros = '<p>HEMOS ENCONTRADO ' . mysqli_num_rows($consulta) . ' registros </p>';
      //INICIO CAMBIOS PARA BORRAR
      // Se almacenan las cadenas de resultado
         echo "<center>";
            echo "<table border='2'>";
               echo "<thead>";
                  echo "<tr><th>id</th><th>Subido por:</th><th>Foto:</th><th>Eliminar</th>";
               echo "</thead>";
               echo "</tbody>";
               while($fila = mysqli_fetch_assoc($consulta)){
               $img = $fila['img'];
               echo "<tr>";
               echo "<td>" . $fila['id'] . "</td>";
               echo "<td>" . $fila['nombreuser'] . "</td>";
               echo "<td>" . "<img src='$img' border='0' width='300' height='100'>" . "</td>";
               echo "<th>"; ?>
               <a href="borrar2.php?id=<?php echo $fila['id']; ?> "> Eliminar</a></th>  
               <?php echo "</th>";
                }
               echo "</tbody>";
            echo "</table>";
         echo "</center>";
//FIN CAMBIOS PARA BORRAR 
   }else{ 
      //javascript
      ?> <script language='javascript'>
      alert('No hay documentos subidas');
      window.location.href='formadministrador.php';
      </script>; 
   <?php
      // $texto = "NO HAY RESULTADOS EN LA BBDD";


   }


      mysqli_close($conexion);
   }

}


   // Resultado, número de registros y contenido.

   echo $registros; echo $texto;
}

      echo "<a href=\"administrador.php\">Volver a página del administrador</a>";
      echo "<br>";
      echo "<a href=\"formadministrador.php\">Volver a inicio</a>";
   ?>
   </div>
</body>
</html>
