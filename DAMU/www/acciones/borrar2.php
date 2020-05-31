<?php  

   //Intento video
   session_start();
   $_SESSION['iniciada'] = true;
   $autor = $_SESSION['nombre'];

   //include 'conf2.php';
   //$usuariofoto = $_POST['usuariofoto'];

   $id = $_REQUEST['id'];
   $conexion = mysqli_connect('db', 'root', 'test', 'myDb') or die("Problemas con la conexión");
   
    //nuevo introducido --> 
    $consulta = mysqli_query($conexion, "SELECT * FROM documentos WHERE id='$id'");

    $registros = mysqli_fetch_array($consulta);
    $campo = $registros['img'];

    $usuariofoto = $registros['nombreuser'];
    //$resultado = $registros[]
    

    if ($consulta)
 {
     echo "Se ha eliminado la foto";
     echo "<br>";
     if($_SESSION['nombre'] == 'Administrador'){
         //nuevo introducido -->   //eliminar el archivo físico
        unlink("..\\recursos\\$usuariofoto\\$campo");
 unlink(realpath($campo));
        //print_r($img);
         //fin nuevo
         echo "<a href=\"formadministrador.php\">Volver a Configuración</a>";
     }else if($_SESSION['nombre'] != 'Administrador'){
         //elimanar el archivo físico
        
         unlink(realpath($campo));
        //unlink("..\\recursos\\$autor\\$campo");
         //unlink("..\\recursos\\$autor\\$resultado");
	
        echo "<a href=\"usuarios.php\">Volver a Configuración</a>";
     }
     
    $consulta2 = mysqli_query($conexion, "DELETE FROM documentos where id ='$id'");
    echo "se eliminó";
     

 } else {
     echo "No se elimino";
 }
   ?>
